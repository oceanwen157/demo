<?php

namespace App\Admin\Controllers;

use App\Models\QorPstars;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Kph\Helpers\ValidateHelper;

class QorPstarsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorPstars';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorPstars());
        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', __('Id'));
        $grid->column('is_hot', __('admin.Is hot'));
        $grid->column('sort', __('admin.Sort'));
        $grid->column('letter', __('admin.Letter'));
        $grid->column('title_en', __('admin.Title en'));
        $grid->column('title_cn', __('admin.Title cn'));
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
        $show = new Show(QorPstars::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('is_hot', __('admin.Is hot'));
        $show->field('trans_status', __('admin.Trans status'));
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

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QorPstars());

        $form->switch('is_hot', __('admin.Is hot'));
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
        $form->text('route_path', __('admin.Route path'))->rules('required')->placeholder('仅支持英文、数字和下划线');
        $form->text('quantity_desc', __('admin.Quantity desc'));

        $form->saving(function (Form $form) {
            $letter = substr(($form->letter ?? $form->title_en), 0, 1);
            $routePath = trim($form->route_path ?? '');

            if (!ValidateHelper::isAlpha($letter)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "首字母必须是英文",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            if (empty($routePath) || !ValidateHelper::isAlphaNumDash($routePath)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => __('admin.Route path') . "仅支持英文、数字和下划线",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            //检查是否有相同的路径
            $chkRow = QorPstars::where(['route_path' => $routePath])->first();
            if ($chkRow && $chkRow->id != intval($form->model()->id)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "该明星的" . __('admin.Route path') . ":{$routePath} 已存在，请换一个",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            $form->sort = intval($form->sort ?? 0);
            $form->letter = strtoupper($letter);
            $form->route_path = $routePath;
            $form->quantity_desc = trim($form->quantity_desc ?? '');
            $form = QorDataService::trimFormMulTitle($form);

            return $form;
        });

        return $form;
    }
}
