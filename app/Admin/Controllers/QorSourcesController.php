<?php

namespace App\Admin\Controllers;

use App\Models\Organizations;
use App\Models\QorSources;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class QorSourcesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorSources';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorSources());

        $grid->column('id', __('Id'));
        $grid->column('sort', __('admin.Sort'));
        $grid->column('letter', __('admin.Letter'));
        $grid->column('origin_name', __('admin.Origin name'));
        $grid->column('title_en', __('admin.Title en'));
        $grid->column('title_cn', __('admin.Title cn'));
        $grid->column('title_tw', __('admin.Title tw'));
        $grid->column('title_ja', __('admin.Title ja'));
        $grid->column('title_ko', __('admin.Title ko'));
        $grid->column('title_ms', __('admin.Title ms'));
        $grid->column('title_th', __('admin.Title th'));
        $grid->column('title_de', __('admin.Title de'));
        $grid->column('title_vi', __('admin.Title vi'));
        $grid->column('title_id', __('admin.Title id'));
        $grid->column('title_pt', __('admin.Title pt'));
        $grid->column('title_tlph', __('admin.Title tlph'));
        $grid->column('create_at', __('admin.Create at'))->display(function () {
            return date('y-m-d H:i', $this->create_at);
        });
        $grid->column('update_at', __('admin.Update at'))->display(function () {
            return date('y-m-d H:i', $this->update_at);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(QorSources::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sort', __('admin.Sort'));
        $show->field('letter', __('admin.Letter'));
        $show->field('origin_name', __('admin.Origin name'));
        $show->field('title_en', __('admin.Title en'));
        $show->field('title_cn', __('admin.Title cn'));
        $show->field('title_tw', __('admin.Title tw'));
        $show->field('title_ja', __('admin.Title ja'));
        $show->field('title_ko', __('admin.Title ko'));
        $show->field('title_ms', __('admin.Title ms'));
        $show->field('title_th', __('admin.Title th'));
        $show->field('title_de', __('admin.Title de'));
        $show->field('title_vi', __('admin.Title vi'));
        $show->field('title_id', __('admin.Title id'));
        $show->field('title_pt', __('admin.Title pt'));
        $show->field('title_tlph', __('admin.Title tlph'));
        $show->field('create_at', __('admin.Create at'));
        $show->field('update_at', __('admin.Update at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QorSources());

        $form->number('sort', __('admin.Sort'));
        $form->text('letter', __('admin.Letter'))->rules('required');
        $form->text('title_en', __('admin.Title en'))->rules('required');
        $form->text('title_cn', __('admin.Title cn'))->default('');
        $form->text('title_tw', __('admin.Title tw'))->default('');
        $form->text('title_ja', __('admin.Title ja'))->default('');
        $form->text('title_ko', __('admin.Title ko'))->default('');
        $form->text('title_ms', __('admin.Title ms'))->default('');
        $form->text('title_th', __('admin.Title th'))->default('');
        $form->text('title_de', __('admin.Title de'))->default('');
        $form->text('title_vi', __('admin.Title vi'))->default('');
        $form->text('title_id', __('admin.Title id'))->default('');
        $form->text('title_pt', __('admin.Title pt'))->default('');
        $form->text('title_tlph', __('admin.Title tlph'))->default('');

        $form->saving(function (Form $form) {
            $letter = substr(($form->letter ?? $form->title_cn), 0, 1);

            $form->sort = intval($form->sort ?? 0);
            $form->letter = strtoupper($letter);
            $form->create_at = time();
            $form->update_at = time();
            $form = QorDataService::trimFormMulTitle($form);

            return $form;
        });

        return $form;
    }
}
