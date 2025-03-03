<?php

namespace App\Admin\Controllers;

use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use App\Services\QorDataService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Kph\Helpers\ValidateHelper;

class QorVideosController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorVideos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorVideos());
        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', __('Id'));
        $grid->column('is_hot', __('admin.Is hot'));
        //$grid->column('trans_status', __('admin.Trans status'));
        $grid->column('cid', __('admin.Cid'));
        $grid->column('pid', __('admin.Pid'));
        $grid->column('sid', __('admin.Sid'));
        $grid->column('duration_num', __('admin.Duration num'));
        //$grid->column('view_num', __('admin.View num'));
        $grid->column('vote_num', __('admin.Vote num'));
//        $grid->column('origin_name', __('admin.Origin name'));
//        $grid->column('cover_ori', __('admin.Cover ori'));
//        $grid->column('cover_new', __('admin.Cover new'));
        $grid->column('source', __('admin.Source'));
//        $grid->column('duration_desc', __('admin.Duration desc'));
//        $grid->column('view_desc', __('admin.View desc'));
//        $grid->column('vote_desc', __('admin.Vote desc'));
        $grid->column('quality_desc', __('admin.Quality desc'));
        $grid->column('vr_desc', __('admin.Vr desc'));
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
//        $grid->column('play_url', __('admin.Play url'));
        $grid->column('publish_at', __('admin.Publish at'))->display(function () {
            return $this->publish_at > 0 ? date('y-m-d H:i', $this->publish_at) : '';
        });
        $grid->column('create_at', __('admin.Create at'))->display(function () {
            return date('y-m-d H:i', $this->create_at);
        });
        $grid->column('update_at', __('admin.Update at'))->display(function () {
            return date('y-m-d H:i', $this->update_at);
        });

        $grid->filter(function($filter){
            $filter->equal('cid', __('admin.Cid'));
            $filter->equal('pid', __('admin.Pid'));
            $filter->equal('sid', __('admin.Sid'));
            $filter->equal('title_en', __('admin.Title en'));
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
        $show = new Show(QorVideos::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('is_hot', __('admin.Is hot'));
        $show->field('trans_status', __('admin.Trans status'));
        $show->field('cid', __('admin.Cid'));
        $show->field('pid', __('admin.Pid'));
        $show->field('sid', __('admin.Sid'));
        $show->field('duration_num', __('admin.Duration num'));
        $show->field('view_num', __('admin.View num'));
        $show->field('vote_num', __('admin.Vote num'));
        $show->field('origin_name', __('admin.Origin name'));
        $show->field('cover_ori', __('admin.Cover ori'));
        $show->field('cover_new', __('admin.Cover new'));
        $show->field('source', __('admin.Source'));
        $show->field('duration_desc', __('admin.Duration desc'));
        $show->field('view_desc', __('admin.View desc'));
        $show->field('vote_desc', __('admin.Vote desc'));
        $show->field('quality_desc', __('admin.Quality desc'));
        $show->field('vr_desc', __('admin.Vr desc'));
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
        $show->field('play_url', __('admin.Play url'));
        $show->field('publish_at', __('admin.Publish at'))->as(function ($val) {
            return $val > 0 ? date('Y-m-d H:i', intval($val)) : '';
        });
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
        $form = new Form(new QorVideos());

        $form->switch('is_hot', __('admin.Is hot'));
        //$form->switch('trans_status', __('admin.Trans status'));
        $form->number('cid', __('admin.Cid'));
        $form->number('pid', __('admin.Pid'));
        $form->number('sid', __('admin.Sid'));
        $form->number('duration_num', __('admin.Duration num'));
        $form->number('view_num', __('admin.View num'));
        $form->number('vote_num', __('admin.Vote num'));
        //$form->text('origin_name', __('admin.Origin name'));
        $form->text('cover_ori', __('admin.Cover ori'));
        $form->text('cover_new', __('admin.Cover new'));
        $form->text('source', __('admin.Source'));
        $form->text('duration_desc', __('admin.Duration desc'));
        $form->text('view_desc', __('admin.View desc'));
        $form->text('vote_desc', __('admin.Vote desc'));
        $form->text('quality_desc', __('admin.Quality desc'));
        $form->text('vr_desc', __('admin.Vr desc'));
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
        $form->text('play_url', __('admin.Play url'))->rules('required');
        //$form->number('publish_at', __('admin.Publish at'));

        $form->saving(function (Form $form) {
            $titleEn = trim($form->title_en ?? '');
            $playUrl = trim($form->play_url ?? '');

            if (empty($playUrl)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => __('admin.Play url') . "不能为空",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            //检查是否有相同的记录
            $chkRow = QorVideos::where(['title_en' => $titleEn])->first();
            if ($chkRow && $chkRow->id != intval($form->model()->id)) {
                $error = new MessageBag([
                    'title' => '提示',
                    'message' => "该视频英文标题:{$titleEn} 已存在，请换一个",
                ]);
                return back()->with(compact('error'))->withInput();
            }

            $form->sort = intval($form->sort ?? 0);
            $form->cid = intval($form->cid ?? 0);
            $form->pid = intval($form->pid ?? 0);
            $form->sid = intval($form->sid ?? 0);
            $form->duration_num = intval($form->duration_num ?? 0);
            $form->view_num = intval($form->view_num ?? 0);
            $form->vote_num = intval($form->vote_num ?? 0);

            $form->cover_ori = trim($form->cover_ori ?? '');
            $form->cover_new = trim($form->cover_new ?? '');
            $form->source = trim($form->source ?? '');
            $form->duration_desc = trim($form->duration_desc ?? '');
            $form->view_desc = trim($form->view_desc ?? '');
            $form->vote_desc = trim($form->vote_desc ?? '');

            $form = QorDataService::trimFormMulTitle($form);

            return $form;
        });

        return $form;
    }
}
