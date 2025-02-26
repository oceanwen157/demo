<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use Encore\Admin\Form;
use Illuminate\Support\Facades\DB;
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
            'letter' => $letter,
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
     * @param string $name
     * @param string $quantityDesc 数量描述,如 58K
     * @return int
     * @throws Throwable
     */
    public static function addCategory(string $name, string $quantityDesc = ''): int
    {
        $name = trim($name);
        if (empty($name)) {
            return 0;
        }

        $row = QorCategories::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            //更新数量描述
            if (!empty($quantityDesc)) {
                DB::transaction(function () use ($row, $quantityDesc) {
                    QorCategories::query()->where([
                        'id' => $row->id,
                    ])->update([
                        'quantity_desc' => $quantityDesc,
                    ]);
                });
            }

            return $row->id;
        }

        $letter = substr($name, 0, 1);
        $route = $name;
        if (!ValidateHelper::isAlphaNumDash($route)) {
            $route = StringHelper::randString(8);
        }

        $data = [
            'letter' => $letter,
            'origin_name' => $name,
            'title_en' => $name,
            'route_path' => $route,
        ];

        $mod = new QorCategories($data);

        DB::transaction(function () use (&$mod) {
            $mod->save();
        });

        return (int)$mod->id;
    }


    /**
     * 新增明星,并返回记录ID;若记录已存在,则返回该记录的ID.为0时,是失败.
     * @param string $name
     * @param string $quantityDesc 数量描述,如 58K
     * @return int
     * @throws Throwable
     */
    public static function addPstar(string $name, string $quantityDesc = ''): int
    {
        $name = trim($name);
        if (empty($name)) {
            return 0;
        }

        $row = QorPstars::query()->where([
            'origin_name' => $name,
        ])->first();
        if ($row) {
            //更新数量描述
            if (!empty($quantityDesc)) {
                DB::transaction(function () use ($row, $quantityDesc) {
                    QorPstars::query()->where([
                        'id' => $row->id,
                    ])->update([
                        'quantity_desc' => $quantityDesc,
                    ]);
                });
            }

            return $row->id;
        }

        $letter = substr($name, 0, 1);
        $route = $name;
        if (!ValidateHelper::isAlphaNumDash($route)) {
            $route = StringHelper::randString(8);
        }

        $data = [
            'letter' => $letter,
            'origin_name' => $name,
            'title_en' => $name,
            'route_path' => $route,
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
