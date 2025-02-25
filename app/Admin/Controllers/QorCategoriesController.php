<?php

namespace App\Admin\Controllers;

use App\Models\QorCategories;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QorCategoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorCategories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorCategories());

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
        $grid->column('route_path', __('admin.Route path'));
        $grid->column('quantity_desc', __('admin.Quantity desc'));
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
        $show = new Show(QorCategories::findOrFail($id));

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
        $show->field('route_path', __('admin.Route path'));
        $show->field('quantity_desc', __('admin.Quantity desc'));
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
        $form = new Form(new QorCategories());

        $form->number('sort', __('admin.Sort'));
        $form->text('letter', __('admin.Letter'))->rules('required');
        $form->text('title_en', __('admin.Title en'))->rules('required');
        $form->text('title_cn', __('admin.Title cn'))->rules('required');
        $form->text('title_tw', __('admin.Title tw'))->rules('required');
        $form->text('title_ja', __('admin.Title ja'))->rules('required');
        $form->text('title_ko', __('admin.Title ko'))->rules('required');
        $form->text('title_ms', __('admin.Title ms'))->rules('required');
        $form->text('title_th', __('admin.Title th'))->rules('required');
        $form->text('title_de', __('admin.Title de'))->rules('required');
        $form->text('title_vi', __('admin.Title vi'))->rules('required');
        $form->text('title_id', __('admin.Title id'))->rules('required');
        $form->text('title_pt', __('admin.Title pt'))->rules('required');
        $form->text('title_tlph', __('admin.Title tlph'))->rules('required');
        $form->text('route_path', __('admin.Route path'))->rules('required');
        $form->text('quantity_desc', __('admin.Quantity desc'));

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
