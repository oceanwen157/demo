<?php

namespace App\Services;

use App\Models\QorCategories;
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
     * 语言对映射
     */
    const LANG_PAIR = [
        // 标识 -> 目标语言
        'en' => 'EN-US',
        'cn' => 'ZH',
        'tw' => 'ZH-HANS',
        'ja' => 'JA',
        'ko' => 'KO',
        'ms' => '',
        'th' => '',
        'de' => 'DE',
        'vi' => '',
        'id' => 'ID',
        'pt' => 'PT-PT',
        'tlph' => '',
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
     * 获取翻译API客户端
     * @return DeepLClient
     * @throws DeepLException
     */
    public static function getApiClient(): DeepLClient
    {
        //api申请地址：https://www.deepl.com/docs-api
        static $client;
        if (!$client) {
            $authKey = env('TRANS_API_KEY', '');
            $client = new DeepLClient($authKey);
        }

        //TODO 使用第三方接口

        return $client;
    }


    public static function transWords(string $words, string $langTag): string
    {
        $words = trim($words);
        $langTag = trim(strtolower($langTag));
        $targetLang = self::tag2Lang($langTag);
        if (empty($words) || empty($langTag) || empty($targetLang)) {
            return $words;
        }

        $key = self::CACHE_PREFIX . md5("{$langTag}:{$words}");
        $res = Redis::get($key);
        if (empty($res)) {
            $client = self::getApiClient();
            if ($langTag == 'tw') {
                //deepl不支持繁体,故要先转为简体
                $words = self::transWords($words, 'cn');

            }
//$res = HanziConvert::convert($str, true);
            $res = 'hello world';
        }

        return $res ?? '';
    }


    /**
     * 模型保存多语言标题
     * @param Model $mod 数据模型
     * @param string $langTag 语言标识
     * @param string $val 新值
     * @return Model
     */
    public static function modelSaveLangTitle(Model $mod, string $langTag, string $val): Model
    {
        $val = trim($val);
        $langTag = trim($langTag);
        $chkTag = !empty($langTag) && in_array($langTag, array_keys(self::LANG_PAIR));
        $field = "title_{$langTag}";
        if ($chkTag && !empty($val) && isset($mod->$field)) {
            $mod->$field = $val;
        }

        return $mod;
    }


    /**
     * 检查模型里的各个多语言标题是否已填充完全
     * @param Model $mod
     * @return bool
     */
    public static function checkModelTitleFull(Model $mod): bool
    {
        $tags = self::getWaitTransTags('en');
        $all = count($tags);
        $num = 0;
        foreach ($tags as $tag) {
            $field = "title_{$tag}";
            if (isset($mod->$field) && trim($mod->$field) != '') {
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
                        $row = self::modelSaveLangTitle($row, $tag, $valueTran);
                    }
                }
            }
            $chkDone = self::checkModelTitleFull($row);
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
     * 翻译明星
     * @return int
     */
    public static function transPstars(): int
    {
        return 0;
    }


    /**
     * 翻译视频
     * @return int
     */
    public static function transVideos(): int
    {
        return 0;
    }


    /**
     * 执行翻译
     * @return void
     */
    public function doTranslate(): void
    {
        self::transCategories();
    }


}
