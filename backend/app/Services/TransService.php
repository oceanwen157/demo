<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPartners;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use Encore\Admin\Form;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use Kph\Helpers\StringHelper;
use Kph\Helpers\ValidateHelper;
use sqhlib\Hanzi\HanziConvert;
use DeepL\DeepLClient;
use DeepL\DeepLException;
use Throwable;

/**
 * 翻译服务
 */
class TransService extends ServiceBase
{


    /**
     * 翻译接口key
     */
    const TRANS_API_KEY = '132f1537f85scxpcm59f7e318b9epa51';


    /**
     * 翻译接口地址
     */
    const TRANS_API_URL = 'http://172.104.184.179:8019/api/ai/chat';


    /**
     * 语言对映射
     */
    const LANG_PAIR = [
        // 标识 -> 目标语言
        'en' => 'English',
        'cn' => 'Chinese Simplified',
        'tw' => 'Chinese Traditional',
        'ja' => 'Japanese',
        'ko' => 'Korean',
        'ms' => 'Bahasa Melayu',
        'th' => 'Thai',
        'de' => 'German',
        'vi' => 'Vietnamese',
        'id' => 'Bahasa Indonesia',
        'pt' => 'Portuguese',
        'tlph' => 'Filipino',
    ];


    /**
     * 缓存前缀
     */
    const CACHE_PREFIX = 'trans:';


    /**
     * 标识转为目标语言
     * @param string $tag
     * @return string
     */
    public static function tag2Lang(string $tag): string
    {
        $res = self::LANG_PAIR[$tag] ?? '';
        return $res;
    }


    /**
     * 获取待翻译的语言标识
     * @param string $exclude 要排除的标识,默认en
     * @return array
     */
    public static function getWaitTransTags(string $exclude = 'en'): array
    {
        $arr = self::LANG_PAIR;
        if (!empty($exclude)) {
            unset($arr[$exclude]);
        }

        return array_keys($arr);
    }


    /**
     * 翻译文本
     * @param string $words 带翻译的英文
     * @param string $langTag 语言标识
     * @param string $field 字段名(不含语言后缀)
     * @return string
     */
    public static function transWords(string $words, string $langTag, string $field = 'title'): string
    {
        $words = trim($words);
        $langTag = trim(strtolower($langTag));
        $targetLang = self::tag2Lang($langTag);
        if (empty($words) || empty($langTag) || empty($targetLang)) {
            return '';
        }

        $wordLen = mb_strlen($words);
        $key = self::CACHE_PREFIX . md5("{$langTag}:{$words}");
        if ($wordLen <= 24) {
            $res = Redis::get($key);
            if (!empty($res)) {
                return $res;
            }
        }

        $now = time();
        $projec = 'waiguo';
        $content = "Translate the following text to {$targetLang}: {$words}";
        $sign = md5($now . self::TRANS_API_KEY);
        $params = [
            'content' => $content,
            'sign' => $sign,
            'time' => $now,
            'project' => $projec,
        ];
        $ret = QorDataService::curlPost(self::TRANS_API_URL, $params);
        if (!empty($ret) && $ret[0] == 200) {
            //结构如 {"code":200,"data":{"content":"極細小 - 適合藍眼睛的寶貝 - 凱特·布魯姆","engine":"chatgpt"},"msg":""}
            $arr = json_decode($ret[1], true);
            $str = $arr['data']['content'] ?? '';
            if (!in_array($field, ['title', 'hint'])) {
                $tmp = explode("\n", $str);
                if (!empty($tmp)) {
                    $res = trim(end($tmp));
                }
            } else {
                $res = trim($str);
            }

            if (!empty($res) && $wordLen <= 24) {
                Redis::setex($key, 1800, $res);
            }
        }

        return $res ?? '';
    }


    /**
     * 模型保存多语言字段值
     * @param Model $mod 数据模型
     * @param string $langTag 语言标识
     * @param string $val 新值
     * @param string $field 字段名(不含语言后缀)
     * @return Model
     */
    public static function modelSaveLangField(Model $mod, string $langTag, string $val, string $field = 'title'): Model
    {
        $val = trim($val);
        $langTag = trim($langTag);
        $chkTag = !empty($langTag) && in_array($langTag, array_keys(self::LANG_PAIR));
        $fieldName = "{$field}_{$langTag}";
        if ($chkTag && !empty($val) && isset($mod->$fieldName)) {
            $mod->$fieldName = $val;
        }

        return $mod;
    }


    /**
     * 检查模型里的各个多语言字段是否已填充完全
     * @param Model $mod
     * @param string $field 字段名(不包含语言后缀)
     * @return bool
     */
    public static function checkModelFieldFull(Model $mod, string $field = 'title'): bool
    {
        $tags = self::getWaitTransTags('en');
        $all = count($tags);
        $num = 0;
        foreach ($tags as $tag) {
            $fieldName = "{$field}_{$tag}}";
            if (isset($mod->$fieldName) && trim($mod->$fieldName) != '') {
                $num++;
            }
        }

        return ($num == $all);
    }


    /**
     * 翻译分类的多语言标题
     * @return int
     */
    public static function transCategories(): int
    {
        $res = 0;
        $tags = self::getWaitTransTags();
        $lastId = 0;
        printf("transCategories begin: %s\n", date("Y-m-d H:i:s"));

        while (true) {
            $qry = QorCategories::query()->whereIn('trans_status', [0, 1]);
            if ($lastId > 0) {
                $qry->where('id', '<', $lastId);
            }

            $row = $qry->orderBy('id', 'desc')->first();
            if (!$row) {
                break;
            }

            printf("category id: %s\n", $row->id);
            $lastId = $row->id;
            $titleEn = $row->title_en;
            foreach ($tags as $tag) {
                $field = "title_{$tag}";
                $value = $row->$field ?? '';
                if (empty($value)) {
                    $valueTran = self::transWords($titleEn, $tag);
                    if (!empty($valueTran) && $valueTran != $value) {
                        $row = self::modelSaveLangField($row, $tag, $valueTran);
                    }
                }
            }
            $chkDone = self::checkModelFieldFull($row);
            printf("trans category id:%s res:%b\n", $row->id, $chkDone);
            if ($chkDone) {
                $res++;
            }
            $row->trans_status = $chkDone ? 2 : 1; //更新状态

            DB::transaction(function () use (&$row) {
                $row->save();
            });
        }

        printf("transCategories done: %d\n", $res);

        return $res;
    }


    /**
     * 翻译明星的多语言标题
     * @return int
     */
    public static function transPstars(): int
    {
        $res = 0;
        $tags = self::getWaitTransTags();
        $lastId = 0;
        printf("transPstars begin: %s\n", date("Y-m-d H:i:s"));

        while (true) {
            $qry = QorPstars::query()->whereIn('trans_status', [0, 1]);
            if ($lastId > 0) {
                $qry->where('id', '<', $lastId);
            }

            $row = $qry->orderBy('id', 'desc')->first();
            if (!$row) {
                break;
            }

            printf("star id: %s\n", $row->id);
            $lastId = $row->id;
            $titleEn = $row->title_en;
            foreach ($tags as $tag) {
                $field = "title_{$tag}";
                $value = $row->$field ?? '';
                if (empty($value)) {
                    $valueTran = self::transWords($titleEn, $tag);
                    if (!empty($valueTran) && $valueTran != $value) {
                        $row = self::modelSaveLangField($row, $tag, $valueTran);
                    }
                }
            }
            $chkDone = self::checkModelFieldFull($row);
            printf("trans star id:%s res:%b\n", $row->id, $chkDone);
            if ($chkDone) {
                $res++;
            }
            $row->trans_status = $chkDone ? 2 : 1; //更新状态

            DB::transaction(function () use (&$row) {
                $row->save();
            });
        }

        printf("transPstars done: %d\n", $res);

        return $res;
    }


    /**
     * 翻译视频的多语言标题
     * @return int
     */
    public static function transVideos(): int
    {
        $res = 0;
        $tags = self::getWaitTransTags();
        $lastId = 0;
        printf("transVideos begin: %s\n", date("Y-m-d H:i:s"));

        while (true) {
            $qry = QorVideos::query()->whereIn('trans_status', [0, 1]);
            if ($lastId > 0) {
                $qry->where('id', '<', $lastId);
            }

            $row = $qry->orderBy('id', 'desc')->first();
            if (!$row) {
                break;
            }

            printf("video id: %s\n", $row->id);
            $lastId = $row->id;
            $titleEn = $row->title_en;
            foreach ($tags as $tag) {
                $field = "title_{$tag}";
                $value = $row->$field ?? '';
                if (empty($value)) {
                    $valueTran = self::transWords($titleEn, $tag);
                    if (!empty($valueTran) && $valueTran != $value) {
                        $row = self::modelSaveLangField($row, $tag, $valueTran);
                    }
                }
            }
            $chkDone = self::checkModelFieldFull($row);
            printf("trans video id:%s res:%b\n", $row->id, $chkDone);
            if ($chkDone) {
                $res++;
            }
            $row->trans_status = $chkDone ? 2 : 1; //更新状态

            DB::transaction(function () use (&$row) {
                $row->save();
            });
        }

        printf("transVideos done: %d\n", $res);

        return $res;
    }


    /**
     * 翻译合作伙伴的多语言字段(标题/提示/描述)
     * @return int
     * @throws Throwable
     */
    public static function transPartners(): int
    {
        $res = 0;
        $tags = self::getWaitTransTags();
        $lastId = 0;
        printf("transPartners begin: %s\n", date("Y-m-d H:i:s"));

        while (true) {
            $qry = QorPartners::query()->whereIn('trans_status', [0, 1]);
            if ($lastId > 0) {
                $qry->where('id', '<', $lastId);
            }

            $row = $qry->orderBy('id', 'desc')->first();
            if (!$row) {
                break;
            }

            printf("partner id: %s\n", $row->id);
            $lastId = $row->id;
            $fields = ['title', 'hint', 'description'];
            foreach ($fields as $fld) {
                $enField = "{$fld}_en";
                $enValue = $row->$enField;;

                foreach ($tags as $tag) {
                    $field = "{$fld}_{$tag}";
                    $value = $row->$field ?? '';

                    if (empty($value)) {
                        $valueTran = self::transWords($enValue, $tag, $fld);
                        if (!empty($valueTran) && $valueTran != $value) {
                            $row = self::modelSaveLangField($row, $tag, $valueTran, $fld);
                        }
                    }
                }
            }

            $chkDone1 = self::checkModelFieldFull($row, 'title');
            $chkDone2 = self::checkModelFieldFull($row, 'hint');
            $chkDone3 = self::checkModelFieldFull($row, 'description');
            $chkDone = $chkDone1 && $chkDone2 && $chkDone3;
            printf("trans partner id:%s res:%b\n", $row->id, $chkDone);
            if ($chkDone) {
                $res++;
            }
            $row->trans_status = $chkDone ? 2 : 1; //更新状态

            DB::transaction(function () use (&$row) {
                $row->save();
            });
        }

        printf("transPartners done: %d\n", $res);

        return $res;
    }


    /**
     * 执行翻译
     * @return void
     */
    public function doTranslate(): void
    {
        self::transPartners();
        self::transCategories();
        self::transPstars();
        self::transVideos();
    }


}
