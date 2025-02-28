<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use Encore\Admin\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Kph\Helpers\StringHelper;
use Kph\Helpers\ValidateHelper;
use Throwable;

class QorDataService extends ServiceBase
{


    /**
     * 过滤后台表单的多语言标题字段
     * @param Form $form
     * @return Form
     */
    public static function trimFormMulTitle(Form $form): Form
    {
        $form->title_en = trim($form->title_en ?? '');
        $form->title_cn = trim($form->title_cn ?? $form->title_en);
        $form->title_tw = trim($form->title_tw ?? $form->title_en);
        $form->title_ja = trim($form->title_ja ?? $form->title_en);
        $form->title_ko = trim($form->title_ko ?? $form->title_en);
        $form->title_ms = trim($form->title_ms ?? $form->title_en);
        $form->title_th = trim($form->title_th ?? $form->title_en);
        $form->title_de = trim($form->title_de ?? $form->title_en);
        $form->title_vi = trim($form->title_vi ?? $form->title_en);
        $form->title_id = trim($form->title_id ?? $form->title_en);
        $form->title_pt = trim($form->title_pt ?? $form->title_en);
        $form->title_tlph = trim($form->title_tlph ?? $form->title_en);

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
     * 新增来源站点,并返回记录ID;若记录已存在,则返回该记录的ID.为0时,是失败.
     * @param string $name 来源名称
     * @return int
     * @throws Throwable
     */
    public
    static function addSource(string $name): int
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
     * @return int
     * @throws Throwable
     */
    public
    static function addCategory(string $name, string $route, string $quantityDesc = '', int $ageLimit = 0): int
    {
        $name = trim($name);
        $route = trim($route);

        if (empty($name)) {
            return 0;
        }
        if (empty($route)) {
            $route = $name;
        }

        $row = QorCategories::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            //更新数量描述
            $data = [];
            if (!empty($quantityDesc)) {
                $data['quantity_desc'] = $quantityDesc;
            }
            if (!empty($ageLimit)) {
                $data['age_limit'] = $ageLimit;
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
            'quantity_desc' => $quantityDesc,
            'age_limit' => $ageLimit,
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
     * @return int
     * @throws Throwable
     */
    public
    static function addPstar(string $name, string $route, string $quantityDesc = '', int $gender = 0): int
    {
        $name = trim($name);
        $route = trim($route);

        if (empty($name)) {
            return 0;
        }
        if (empty($route)) {
            $route = $name;
        }

        $row = QorPstars::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            //更新数量描述
            $data = [];
            if (!empty($quantityDesc)) {
                $data['quantity_desc'] = $quantityDesc;
            }
            if (!empty($gender)) {
                $data['gender'] = $gender;
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
            'quantity_desc' => $quantityDesc,
            'gender' => $gender,
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
     * ];
     * @return int
     */
    public
    function addVideoInfo(array $param = []): int
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

        if (empty($title)) {
            $this->setErrorInfo('title 不能为空');
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
        $cid = self::addCategory($category);

        //添加明星
        $pid = self::addPstar($star);

        //添加来源
        $sid = self::addSource($source);

        //检查视频是否已存在
        $row = QorVideos::query()->where([
            'origin_name' => $title,
        ])->first();

        $data = [
            'cid' => $cid,
            'pid' => $pid,
            'sid' => $sid,
            'duration_num' => 0,
            'vote_num' => 0,
            'origin_name' => $title,
            'cover_ori' => $coverOri,
            'cover_new' => $coverNew,
            'source' => $source,
            'duration_desc' => $durationDesc,
            'vote_desc' => $voteDesc,
            'title_en' => $title,
            'play_url' => $playUrl,
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


}
