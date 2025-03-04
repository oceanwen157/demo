<?php

namespace App\Admin\Controllers;

use App\Models\QorPartners;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Kph\Helpers\ValidateHelper;

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
        $frontUrl = trim(env('FRONT_URL', ''), '/') . '/';

        $grid->column('id', __('Id'));
        //$grid->column('trans_status', __('Trans status'));
        $grid->column('sort', __('Sort'));
        $grid->column('name', __('Name'));
        $grid->column('logo', __('admin.Logo'))->image($frontUrl, 100, 100);
        $grid->column('route_path', __('admin.Route path'));
        $grid->column('title_en', __('admin.Title en'));
//        $grid->column('title_cn', __('Title cn'));
//        $grid->column('title_tw', __('Title tw'));
//        $grid->column('title_ja', __('Title ja'));
//        $grid->column('title_ko', __('Title ko'));
//        $grid->column('title_ms', __('Title ms'));
//        $grid->column('title_th', __('Title th'));
//        $grid->column('title_de', __('Title de'));
//        $grid->column('title_vi', __('Title vi'));
//        $grid->column('title_id', __('Title id'));
//        $grid->column('title_pt', __('Title pt'));
//        $grid->column('title_tlph', __('Title tlph'));
//        $grid->column('hint_en', __('Hint en'));
//        $grid->column('hint_cn', __('Hint cn'));
//        $grid->column('hint_tw', __('Hint tw'));
//        $grid->column('hint_ja', __('Hint ja'));
//        $grid->column('hint_ko', __('Hint ko'));
//        $grid->column('hint_ms', __('Hint ms'));
//        $grid->column('hint_th', __('Hint th'));
//        $grid->column('hint_de', __('Hint de'));
//        $grid->column('hint_vi', __('Hint vi'));
//        $grid->column('hint_id', __('Hint id'));
//        $grid->column('hint_pt', __('Hint pt'));
//        $grid->column('hint_tlph', __('Hint tlph'));
//        $grid->column('description_en', __('Description en'));
//        $grid->column('description_cn', __('Description cn'));
//        $grid->column('description_tw', __('Description tw'));
//        $grid->column('description_ja', __('Description ja'));
//        $grid->column('description_ko', __('Description ko'));
//        $grid->column('description_ms', __('Description ms'));
//        $grid->column('description_th', __('Description th'));
//        $grid->column('description_de', __('Description de'));
//        $grid->column('description_vi', __('Description vi'));
//        $grid->column('description_id', __('Description id'));
//        $grid->column('description_pt', __('Description pt'));
//        $grid->column('description_tlph', __('Description tlph'));
        $grid->column('create_at', __('admin.Create at'))->display(function () {
            return date('y-m-d H:i', $this->create_at);
        });
        $grid->column('update_at', __('admin.Update at'))->display(function () {
            return date('y-m-d H:i', $this->update_at);
        });

        $grid->filter(function ($filter) {
            $filter->equal('name', __('admin.Name'));
            $filter->equal('route_path', __('Route path'));
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
        //$show->field('trans_status', __('admin.Trans status'));
        $show->field('sort', __('admin.Sort'));
        $show->field('name', __('admin.Name'));
        $show->field('logo', __('admin.Logo'));
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

        //上传到前台站的目录
        $day = date('Ym');
        $baseDir = dirname(base_path('')) . "/frontend/public/uploads/images/{$day}";
        $imgDir = "uploads/{$day}";
        if (!file_exists($baseDir)) {
            @mkdir($imgDir, 0777, true);
        }

        $form->text('name', __('admin.Name'))->rules('required');
        $form->text('route_path', __('admin.Route path'))->rules('required');
        $form->image('logo', __('admin.Logo'))
            ->uniqueName()
            ->removable()->move($imgDir);

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
            $routePath = trim($form->route_path ?? '');

            if (empty($routePath) || !QorDataService::checkRoute($routePath)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => __('admin.Route path') . "只允许字母、数字、下划线、中划线",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            //检查是否有相同的名称
            $chkRow = QorPartners::where(['name' => $name])->first();
            if ($chkRow && $chkRow->id != intval($form->model()->id)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "该" . __('admin.Name') . ":{$name} 已存在，请换一个",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            //检查是否有相同的路由
            $chkRow = QorPartners::where(['route_path' => $routePath])->first();
            if ($chkRow && $chkRow->id != intval($form->model()->id)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "该" . __('admin..Route path') . ":{$name} 已存在，请换一个",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            $form->sort = intval($form->sort ?? 0);
            $form->route_path = $routePath;

            $form = QorDataService::trimFormMulTitle($form, 'title');
            $form = QorDataService::trimFormMulTitle($form, 'hint');
            $form = QorDataService::trimFormMulTitle($form, 'description');
            return $form;
        });

        return $form;
    }
}
