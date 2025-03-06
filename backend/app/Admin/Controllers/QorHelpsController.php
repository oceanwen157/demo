<?php

namespace App\Admin\Controllers;

use App\Models\QorHelps;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class QorHelpsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorHelps';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorHelps());
        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', __('admin.Id'));
        //$grid->column('trans_status', __('admin.Trans status'));
        $grid->column('sort', __('admin.Sort'));
        $grid->column('route_path', __('admin.Route path'));
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
//        $grid->column('content_en', __('admin.Content en'));
//        $grid->column('content_cn', __('admin.Content cn'));
//        $grid->column('content_tw', __('admin.Content tw'));
//        $grid->column('content_ja', __('admin.Content ja'));
//        $grid->column('content_ko', __('admin.Content ko'));
//        $grid->column('content_ms', __('admin.Content ms'));
//        $grid->column('content_th', __('admin.Content th'));
//        $grid->column('content_de', __('admin.Content de'));
//        $grid->column('content_vi', __('admin.Content vi'));
//        $grid->column('content_id', __('admin.Content id'));
//        $grid->column('content_pt', __('admin.Content pt'));
//        $grid->column('content_tlph', __('admin.Content tlph'));
        $grid->column('create_at', __('admin.Create at'))->display(function () {
            return date('y-m-d H:i', $this->create_at);
        });
        $grid->column('update_at', __('admin.Update at'))->display(function () {
            return date('y-m-d H:i', $this->update_at);
        });

        $grid->filter(function ($filter) {
            $filter->equal('route_path', __('admin.Route path'));
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
        $show = new Show(QorHelps::findOrFail($id));

        $show->field('id', __('admin.Id'));
        //$show->field('trans_status', __('admin.Trans status'));
        $show->field('sort', __('admin.Sort'));
        $show->field('route_path', __('admin.Route path'));
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
        $show->field('content_en', __('admin.Content en'));
        $show->field('content_cn', __('admin.Content cn'));
        $show->field('content_tw', __('admin.Content tw'));
        $show->field('content_ja', __('admin.Content ja'));
        $show->field('content_ko', __('admin.Content ko'));
        $show->field('content_ms', __('admin.Content ms'));
        $show->field('content_th', __('admin.Content th'));
        $show->field('content_de', __('admin.Content de'));
        $show->field('content_vi', __('admin.Content vi'));
        $show->field('content_id', __('admin.Content id'));
        $show->field('content_pt', __('admin.Content pt'));
        $show->field('content_tlph', __('admin.Content tlph'));
        //$show->field('create_at', __('admin.Create at'));
        //$show->field('update_at', __('admin.Update at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QorHelps());

        //$form->switch('trans_status', __('admin.Trans status'));
        $form->number('sort', __('admin.Sort'));
        $form->text('route_path', __('admin.Route path'))->rules('required');
        $form->text('title_en', __('admin.Title en'))->rules('required');
        $form->quill('content_en', __('admin.Content en'))->rules('required');

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

        $form->quill('content_cn', __('admin.Content cn'));
        $form->quill('content_tw', __('admin.Content tw'));
        $form->quill('content_ja', __('admin.Content ja'));
        $form->quill('content_ko', __('admin.Content ko'));
        $form->quill('content_ms', __('admin.Content ms'));
        $form->quill('content_th', __('admin.Content th'));
        $form->quill('content_de', __('admin.Content de'));
        $form->quill('content_vi', __('admin.Content vi'));
        $form->quill('content_id', __('admin.Content id'));
        $form->quill('content_pt', __('admin.Content pt'));
        $form->quill('content_tlph', __('admin.Content tlph'));

        $form->saving(function (Form $form) {
            $routePath = trim($form->route_path ?? '');

            if (empty($routePath) || !QorDataService::checkRoute($routePath)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => __('admin.Route path') . "只允许字母、数字、下划线、中划线",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            //检查是否有相同的路由
            $chkRow = QorHelps::where(['route_path' => $routePath])->first();
            if ($chkRow && $chkRow->id != intval($form->model()->id)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "该" . __('admin..Route path') . " 已存在，请换一个",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            $form->sort = intval($form->sort ?? 0);
            $form->route_path = $routePath;

            $form = QorDataService::trimFormMulTitle($form, 'title');
            $form = QorDataService::trimFormMulTitle($form, 'content');
            return $form;
        });


        return $form;
    }
}
