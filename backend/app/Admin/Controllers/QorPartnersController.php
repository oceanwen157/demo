<?php

namespace App\Admin\Controllers;

use App\Models\QorPartners;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QorPartnersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorPartners';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorPartners());
        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', __('Id'));
        $grid->column('name', __('admin.Name'));
        $grid->column('logo', __('admin.Logo'));
        $grid->column('sort', __('admin.Sort'));
        $grid->column('title_en', __('admin.Title en'));
//        $grid->column('title_cn', __('admin.Title cn'));
//        $grid->column('title_tw', __('admin.Title tw'));
//        $grid->column('title_ja', __('admin.Title ja'));
//        $grid->column('title_ko', __('admin.Title ko'));
//        $grid->column('title_ms', __('admin.Title ms'));
//        $grid->column('title_th', __('admin.Title th'));
//        $grid->column('title_de', __('admin.Title de'));
//        $grid->column('title_vi', __('admin.Title vi'));
//        $grid->column('title_id', __('admin.Title id'));
//        $grid->column('title_pt', __('admin.Title pt'));
//        $grid->column('title_tlph', __('admin.Title tlph'));
        $grid->column('hint_en', __('admin.Hint en'));
//        $grid->column('hint_cn', __('admin.Hint cn'));
//        $grid->column('hint_tw', __('admin.Hint tw'));
//        $grid->column('hint_ja', __('admin.Hint ja'));
//        $grid->column('hint_ko', __('admin.Hint ko'));
//        $grid->column('hint_ms', __('admin.Hint ms'));
//        $grid->column('hint_th', __('admin.Hint th'));
//        $grid->column('hint_de', __('admin.Hint de'));
//        $grid->column('hint_vi', __('admin.Hint vi'));
//        $grid->column('hint_id', __('admin.Hint id'));
//        $grid->column('hint_pt', __('admin.Hint pt'));
//        $grid->column('hint_tlph', __('admin.Hint tlph'));
//        $grid->column('description_en', __('admin.Description en'));
//        $grid->column('description_cn', __('admin.Description cn'));
//        $grid->column('description_tw', __('admin.Description tw'));
//        $grid->column('description_ja', __('admin.Description ja'));
//        $grid->column('description_ko', __('admin.Description ko'));
//        $grid->column('description_ms', __('admin.Description ms'));
//        $grid->column('description_th', __('admin.Description th'));
//        $grid->column('description_de', __('admin.Description de'));
//        $grid->column('description_vi', __('admin.Description vi'));
//        $grid->column('description_id', __('admin.Description id'));
//        $grid->column('description_pt', __('admin.Description pt'));
//        $grid->column('description_tlph', __('admin.Description tlph'));
        $grid->column('create_at', __('admin.Create at'))->display(function () {
            return date('y-m-d H:i', $this->create_at);
        });
        $grid->column('update_at', __('admin.Update at'))->display(function () {
            return date('y-m-d H:i', $this->update_at);
        });

        $grid->filter(function ($filter) {
            $filter->equal('name', __('admin.Name'));
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
        $show = new Show(QorPartners::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('admin.Name'));
        $show->field('logo', __('admin.Logo'));
        $show->field('sort', __('admin.Sort'));
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
        $show->field('hint_en', __('admin.Hint en'));
        $show->field('hint_cn', __('admin.Hint cn'));
        $show->field('hint_tw', __('admin.Hint tw'));
        $show->field('hint_ja', __('admin.Hint ja'));
        $show->field('hint_ko', __('admin.Hint ko'));
        $show->field('hint_ms', __('admin.Hint ms'));
        $show->field('hint_th', __('admin.Hint th'));
        $show->field('hint_de', __('admin.Hint de'));
        $show->field('hint_vi', __('admin.Hint vi'));
        $show->field('hint_id', __('admin.Hint id'));
        $show->field('hint_pt', __('admin.Hint pt'));
        $show->field('hint_tlph', __('admin.Hint tlph'));
        $show->field('description_en', __('admin.Description en'));
        $show->field('description_cn', __('admin.Description cn'));
        $show->field('description_tw', __('admin.Description tw'));
        $show->field('description_ja', __('admin.Description ja'));
        $show->field('description_ko', __('admin.Description ko'));
        $show->field('description_ms', __('admin.Description ms'));
        $show->field('description_th', __('admin.Description th'));
        $show->field('description_de', __('admin.Description de'));
        $show->field('description_vi', __('admin.Description vi'));
        $show->field('description_id', __('admin.Description id'));
        $show->field('description_pt', __('admin.Description pt'));
        $show->field('description_tlph', __('admin.Description tlph'));
//        $show->field('create_at', __('admin.Create at'));
//        $show->field('update_at', __('admin.Update at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QorPartners());

        $form->text('name', __('admin.Name'))->rules('required');
        $form->text('logo', __('admin.Logo'));
        $form->image('image', __('admin.Upload'));
        $form->number('sort', __('admin.Sort'))->default(99);
        $form->text('title_en', __('admin.Title en'))->rules('required');
        $form->text('title_cn', __('admin.Title cn'));
        $form->text('title_tw', __('admin.Title tw'));
        $form->text('title_ja', __('admin.Title ja'));
        $form->text('title_ko', __('admin.Title ko'));
        $form->text('title_ms', __('admin.Title ms'));
        $form->text('title_th', __('admin.Title th'));
        $form->text('title_de', __('admin.Title de'));
        $form->text('title_vi', __('admin.Title vi'));
        $form->text('title_id', __('admin.Title id'));
        $form->text('title_pt', __('admin.Title pt'));
        $form->text('title_tlph', __('admin.Title tlph'));
        $form->text('hint_en', __('admin.Hint en'))->rules('required');
        $form->text('hint_cn', __('admin.Hint cn'));
        $form->text('hint_tw', __('admin.Hint tw'));
        $form->text('hint_ja', __('admin.Hint ja'));
        $form->text('hint_ko', __('admin.Hint ko'));
        $form->text('hint_ms', __('admin.Hint ms'));
        $form->text('hint_th', __('admin.Hint th'));
        $form->text('hint_de', __('admin.Hint de'));
        $form->text('hint_vi', __('admin.Hint vi'));
        $form->text('hint_id', __('admin.Hint id'));
        $form->text('hint_pt', __('admin.Hint pt'));
        $form->text('hint_tlph', __('admin.Hint tlph'));
        $form->textarea('description_en', __('admin.Description en'))->rules('required');
        $form->textarea('description_cn', __('admin.Description cn'));
        $form->textarea('description_tw', __('admin.Description tw'));
        $form->textarea('description_ja', __('admin.Description ja'));
        $form->textarea('description_ko', __('admin.Description ko'));
        $form->textarea('description_ms', __('admin.Description ms'));
        $form->textarea('description_th', __('admin.Description th'));
        $form->textarea('description_de', __('admin.Description de'));
        $form->textarea('description_vi', __('admin.Description vi'));
        $form->textarea('description_id', __('admin.Description id'));
        $form->textarea('description_pt', __('admin.Description pt'));
        $form->textarea('description_tlph', __('admin.Description tlph'));

        $form->saving(function (Form $form) {
            $name = trim($form->name ?? '');

            //检查是否有相同的名称
            $chkRow = QorPartners::where(['name' => $name])->first();
            if ($chkRow && $chkRow->id != intval($form->model()->id)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "该" . __('admin.Name') . ":{$name} 已存在，请换一个",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            $form = QorDataService::trimFormMulTitle($form, 'title');
            $form = QorDataService::trimFormMulTitle($form, 'hint');
            $form = QorDataService::trimFormMulTitle($form, 'description');
            return $form;
        });

        return $form;
    }
}
