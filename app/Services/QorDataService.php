<?php

namespace App\Services;

use Encore\Admin\Form;

class QorDataService extends ServiceBase
{

    //过滤后台表单的多语言标题字段
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

}
