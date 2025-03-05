<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use App\Jobs\UpdateImageRealPathJob;
use Encore\Admin\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Kph\Helpers\StringHelper;
use Kph\Helpers\ValidateHelper;
use Throwable;

class QorDataService extends ServiceBase
{

    const UPLOAD_IMG_API = 'https://upload-outside.yesebo.net/api/system/image';

    const UPLOAD_SIGN_KEY = '8ThqREd2YlAB7zIvGp1dOhlRvdz956jd';

    /**
     * 过滤后台表单的多语言标题字段
     * @param Form $form
     * @return Form
     */
    public static function trimFormMulTitle(Form $form, string $field = 'title'): Form
    {

        $tags = array_keys(TransService::LANG_PAIR);
        foreach ($tags as $tag) {
            $fieldName = "{$field}_{$tag}";
            $value = trim($form->$fieldName ?? '');
            $form->$fieldName = $value;
        }

        return $form;
    }


    /**
     * 检查路由是否合法
     * @param string $route
     * @return bool
     */
    public static function checkRoute(string $route): bool
    {
        //只允许字母、数字、下划线、中划线
        $pattern = '/^[A-Za-z0-9\_\-]+$/';
        $res = !empty($route) && @preg_match($pattern, $route);
        return $res;
    }


    /**
     * 生成路由
     * @param string $route
     * @return string
     */
    public static function makeRoute(string $route): string
    {
        $arr = explode('/', rtrim($route, '/'));
        $res = trim(end($arr));
        if (empty($res) || !self::checkRoute($res)) {
            $res = strtolower(StringHelper::randString(8, 0));
        }

        return $res;
    }


    /**
     * 根据语言后缀获取多语言的标题
     * @param Model $mod 数据模型
     * @param string $langSuffix 语言后缀,值有
     * - en,英文
     * - cn,简体中文
     * - tw,繁体中文
     * - ja,日文
     * - ko,韩文
     * - ms,马来文
     * - th,泰文
     * - de,德文
     * - vi,越南文
     * - id,印尼文
     * - pt,葡萄牙文
     * - tlph,菲律宾文
     * @return string
     */
    public static function getTitleByLang(Model $mod, string $langSuffix = ''): string
    {
        $default = trim($mod->title_en ?? '');
        if (empty($langSuffix)) {
            return $default;
        }

        $field = "title_{$langSuffix}";
        $res = trim($mod->$field ?? '');
        if (empty($res)) {
            $res = $default;
        }

        return $res;
    }


    /**
     * 将数量描述转为数值
     * @param string $quantity 如 45K
     * @return int
     */
    public static function quantityDesc2Number(string $quantity): int
    {
        $quantity = strtolower(trim($quantity));
        $base = str_replace('k', '', $quantity);
        $base = str_replace('m', '', $base);
        $num = 0;
        if (strpos($base, 'k') !== false) {
            $num = intval($quantity) * 1000;
        }
        if (strpos($base, 'm') !== false) {
            $num = intval($quantity) * 10000;
        }

        return $num;
    }


    /**
     * hms时长字符串转为秒数
     * @param string $str 时长,如 11:22:33
     * @return int
     */
    public static function hmsToSeconds(string $str): int
    {
        $str = trim($str);
        if (empty($str)) {
            return 0;
        }

        $res = 0;
        $arr = explode(':', $str);
        $len = count($arr);
        for ($i = 0; $i <= $len - 1; $i++) {
            $num = intval(end($arr));
            $res += $num * pow(60, $i);
        }

        return $res;
    }


    /**
     * 时间距离描述转为时间戳
     * @param string $str 字符串,如 2 months ago
     * @return int
     */
    public static function strToTimestamp(string $str): int
    {
        $res = time();
        $str = strtolower(trim($str));
        if (empty($str)) {
            $now = time();
            $arr = explode(' ', $str);
            $diff = 0;
            if (StringHelper::contains($str, 'hour')) {
                $diff = intval($arr[0] ?? '') * 3600;
            } elseif (StringHelper::contains($str, 'day')) {
                $diff = intval($arr[0] ?? '') * 86400;
            } elseif (StringHelper::contains($str, 'week')) {
                $diff = intval($arr[0] ?? '') * 604800;
            } elseif (StringHelper::contains($str, 'month')) {
                $diff = intval($arr[0] ?? '') * 2592000;
            } elseif (StringHelper::contains($str, 'year')) {
                $diff = intval($arr[0] ?? '') * 31556952;
            }

            $res = abs($now - $diff);
        }

        return $res;
    }

    public static function generateTimestamp(): int
    {
        $currentTimestamp = time(); 
        $fourYearsAgo = strtotime('-4 years'); 
        
        return rand($fourYearsAgo, $currentTimestamp); 
    }


    /**
     * 投票描述转为数值
     * @param string $vote 投票描述,如 89%
     * @return int
     */
    public static function voteDesc2Number(string $vote): int
    {
        $base = str_replace('%', '', $vote);
        $res = intval($base);
        return $res;
    }


    /**
     * 新增来源站点,并返回记录ID;若记录已存在,则返回该记录的ID.为0时,是失败.
     * @param string $name 来源名称
     * @return int
     * @throws Throwable
     */
    public static function addSource(string $name): int
    {
        $name = trim($name);
        if (empty($name)) {
            return 0;
        }

        $row = QorSources::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            return $row->id;
        }

        $letter = substr($name, 0, 1);
        $data = [
            'letter' => ValidateHelper::isAlpha($letter) ? strtoupper($letter) : '',
            'origin_name' => $name,
            'title_en' => $name,
        ];

        $mod = new QorSources($data);

        DB::transaction(function () use (&$mod) {
            $mod->save();
        });

        return (int)$mod->id;
    }


    /**
     * 新增分类,并返回记录ID;若记录已存在,则返回该记录的ID.为0时,是失败.
     * @param string $name 名称
     * @param string $route 路由
     * @param string $quantityDesc 数量描述,如 58K
     * @param int $ageLimit 年龄限制
     * @param int $isHot 是否热门：0否 1是
     * @return int
     * @throws Throwable
     */
    public
    static function addCategory(string $name, string $route, string $quantityDesc = '', int $ageLimit = 0, int $isHot = 1): int
    {
        $name = trim($name);
        $route = trim($route);

        if (empty($name)) {
            return 0;
        }
        if (empty($route)) {
            $route = $name;
        }

        $quantityDesc = trim($quantityDesc);
        $quantityNum = self::quantityDesc2Number($quantityDesc);

        $row = QorCategories::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            //更新数量描述
            $data = [];
            if (!empty($quantityDesc)) {
                $data['quantity_num'] = $quantityNum;
                $data['quantity_desc'] = $quantityDesc;
            }
            if (!empty($ageLimit)) {
                $data['age_limit'] = $ageLimit;
            }
            if ($isHot) {
                $data['is_hot'] = $isHot;
            }

            if (!empty($data)) {
                DB::transaction(function () use ($row, $data) {
                    QorCategories::query()->where([
                        'id' => $row->id,
                    ])->update($data);
                });
            }

            return $row->id;
        }

        $letter = substr($name, 0, 1);
        $newRoute = self::makeRoute($route);
        $data = [
            'letter' => ValidateHelper::isAlpha($letter) ? strtoupper($letter) : '',
            'origin_name' => $name,
            'title_en' => $name,
            'route_ori' => $route,
            'route_path' => $newRoute,
            'quantity_num' => $quantityNum,
            'quantity_desc' => $quantityDesc,
            'age_limit' => $ageLimit,
            'is_hot' => $isHot ? 1 : 0,
        ];

        $mod = new QorCategories($data);

        DB::transaction(function () use (&$mod) {
            $mod->save();
        });

        return (int)$mod->id;
    }


    /**
     * 新增明星,并返回记录ID;若记录已存在,则返回该记录的ID.为0时,是失败.
     * @param string $name 名称
     * @param string $route 路由
     * @param string $quantityDesc 数量描述,如 58K
     * @param int $gender 性别，0未知,1男性,2女性
     * @param int $isHot 是否热门：0否 1是
     * @return int
     * @throws Throwable
     */
    public
    static function addPstar(string $name, string $route, string $quantityDesc = '', int $gender = 0, int $isHot = 1): int
    {
        $name = trim($name);
        $route = trim($route);

        if (empty($name)) {
            return 0;
        }
        if (empty($route)) {
            $route = $name;
        }

        $quantityDesc = trim($quantityDesc);
        $quantityNum = self::quantityDesc2Number($quantityDesc);

        $row = QorPstars::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            //更新数量描述
            $data = [];
            if (!empty($quantityDesc)) {
                $data['quantity_num'] = $quantityNum;
                $data['quantity_desc'] = $quantityDesc;
            }
            if (!empty($gender)) {
                $data['gender'] = $gender;
            }
            if ($isHot) {
                $data['is_hot'] = $isHot;
            }

            if (!empty($data)) {
                DB::transaction(function () use ($row, $data) {
                    QorPstars::query()->where([
                        'id' => $row->id,
                    ])->update($data);
                });
            }

            return $row->id;
        }

        $letter = substr($name, 0, 1);
        $newRoute = self::makeRoute($route);

        $data = [
            'letter' => ValidateHelper::isAlpha($letter) ? strtoupper($letter) : '',
            'origin_name' => $name,
            'title_en' => $name,
            'route_ori' => $route,
            'route_path' => $newRoute,
            'quantity_num' => $quantityNum,
            'quantity_desc' => $quantityDesc,
            'gender' => $gender,
            'is_hot' => $isHot ? 1 : 0,
        ];

        $mod = new QorPstars($data);

        DB::transaction(function () use (&$mod) {
            $mod->save();
        });

        return (int)$mod->id;
    }


    /**
     * 新增视频信息,并返回记录ID;若记录已存在,则返回该记录的ID.为0时,是失败.
     * @param array $param 参数数组,形如
     * $param = [
     * 'title' => '标题,必填',
     * 'coverOri' => '原站的封面图片地址,必填',
     * 'coverNew' => '经下载再上传的新封面图片地址,必填',
     * 'playUrl' => '播放地址,必填',
     * 'category' => '分类名称,和明星名称,二者中必填一项',
     * 'star' => '明星名称,和分类名称,二者中必填一项',
     * 'source' => '来源,选填',
     * 'durationDesc' => '时长描述,必填,如 1:50:51 ',
     * 'voteDesc' => '投票描述,选填,如 75%',
     * 'qualityDesc' => '分辨率描述,选填,如 HD',
     * 'vrDesc' => 'VR描述,选填,如 VR',
     * 'timeDesc' => '发布时间描述,选填,如 3 years ago',
     * 'ageLimit' => '年龄限制,选填,如 18',
     * 'gender' => '明星的性别,选填,0未知,1男性,2女性',
     * 'quantityDesc' => '分类/明星下的数量描述,选填,如 45K',
     * 'routeOri' => '分类/明星的路由,必填',
     * ];
     * @return int
     */
    public function addVideoInfo(array $param = []): int
    {
        extract($param);
        $title = trim($title ?? '');
        $coverOri = trim($coverOri ?? '');
        $coverNew = trim($coverNew ?? '');
        $playUrl = trim($playUrl ?? '');
        $category = trim($category ?? '');
        $star = trim($star ?? '');
        $source = trim($source ?? '');
        $durationDesc = trim($durationDesc ?? '');
        $voteDesc = trim($voteDesc ?? '');

        $ageLimit = intval($ageLimit ?? '');
        $gender = intval($gender ?? '');
        $quantityDesc = trim($quantityDesc ?? '');
        $routeOri = trim($routeOri ?? '');

        //TODO 新增的字段信息
        $qualityDesc = trim($qualityDesc ?? '');
        $vrDesc = trim($vrDesc ?? '');
        $timeDesc = trim($timeDesc ?? '');

        if (empty($title)) {
            $this->setErrorInfo('title 不能为空');
            return 0;
        }
        if (empty($routeOri)) {
            $this->setErrorInfo('routeOri 不能为空');
            return 0;
        }
        if (empty($coverOri)) {
            $this->setErrorInfo('coverOri 不能为空');
            return 0;
        }
        if (empty($coverNew)) {
            $this->setErrorInfo('coverNew 不能为空');
            return 0;
        }
        if (empty($playUrl)) {
            $this->setErrorInfo('playUrl 不能为空');
            return 0;
        }

        if (empty($category) && empty($star)) {
            $this->setErrorInfo('category 和 star 不能同时为空');
            return 0;
        }

        //添加分类
        $cid = self::addCategory($category, $routeOri, $quantityDesc, $ageLimit);

        //添加明星
        $pid = self::addPstar($star, $routeOri, $quantityDesc, $gender);

        //添加来源
        $sid = self::addSource($source);

        //检查视频是否已存在
        $row = QorVideos::query()->where([
            'origin_name' => $title,
        ])->first();

        $durationNum = self::hmsToSeconds($durationDesc);
        $voteNum = self::voteDesc2Number($voteDesc);
        $publishAt = self::generateTimestamp();
        $data = [
            'cid' => $cid,
            'pid' => $pid,
            'sid' => $sid,
            'origin_name' => $title,
            'cover_ori' => $coverOri,
            'cover_new' => $coverNew,
            'source' => $source,
            'duration_num' => $durationNum,
            'duration_desc' => $durationDesc,
            'vote_num' => $voteNum,
            'vote_desc' => $voteDesc,
            'quality_desc' => $qualityDesc,
            'vr_desc' => $vrDesc,
            'title_en' => $title,
            'play_url' => $playUrl,
            'publish_at' => $publishAt,
        ];

        $res = 0;
        DB::transaction(function () use (&$res, $row, $data) {
            if ($row) { //更新
                $ret = QorVideos::query()->where([
                    'id' => $row->id,
                ])->update($data);
                if ($ret) {
                    $res = $row->id;
                }
            } else { //插入
                $mod = new QorVideos($data);
                $ret = $mod->save();
                if ($ret) {
                    $res = $mod->id;
                }
            }
        });

        return $res;
    }

    public static function updateImages()
    {
        QorVideos::where('cover_new', 'xxx')
        ->chunk(100, function ($chunk) {
            foreach ($chunk as $record) {
                UpdateImageRealPathJob::dispatch($record);
            }
        });
    }

    public static function makeUploadSign($array, $signKey = ''): string
    {
        if (empty($array)) {
            return '';
        }
        ksort($array);

        $arr_temp = array();
        foreach ($array as $key => $val) {
            if ($key == 'data') {
                $valTemp = str_replace(' ', '+', $val);
                $arr_temp[] = $key . '=' . $valTemp;
            } else {
                $arr_temp[] = $key . '=' . $val;
            }
        }
        $string = implode('&', $arr_temp);

        if (empty($signKey)) {
            $signKey = self::UPLOAD_SIGN_KEY;
        }
        $string = $string . $signKey;

        $res = md5(hash('sha256', $string));

        return $res;
    }

    public static function curlPost(string $url, array $params, int $timeout = 60): array
    {
        $res = [];
        if (empty($url)) {
            return $res;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        //curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1");
        //curl_setopt($ch, CURLOPT_PROXYPORT, 10808);

        $response = curl_exec($ch);
        $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errno = @curl_errno($ch);
        if ($errno) {
            //var_dump('-----------------err:', $errno, $params);
            return [$code, ''];
        }

        @curl_close($ch);
        $resp = strval($response);
        //var_dump('--------------curl req:', $url, $params);
        //var_dump('--------------curl res:', $code, $resp);

        return [$code, $resp];
    }

}
