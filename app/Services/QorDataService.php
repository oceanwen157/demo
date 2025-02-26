<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
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
            DB::transaction(function () use ($row, $quantityDesc) {
                QorCategories::query()->where([
                    'id' => $row->id,
                ])->update([
                    'quantity_desc' => $quantityDesc,
                ]);
            });

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
            DB::transaction(function () use ($row, $quantityDesc) {
                QorPstars::query()->where([
                    'id' => $row->id,
                ])->update([
                    'quantity_desc' => $quantityDesc,
                ]);
            });

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


}
