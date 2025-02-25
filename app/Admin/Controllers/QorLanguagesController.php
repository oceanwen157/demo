<?php

namespace App\Admin\Controllers;

use App\Models\QorLanguages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QorLanguagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QorLanguages';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QorLanguages());
        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', __('Id'));
        $grid->column('sort', __('排序'));
        $grid->column('tag', __('标识'));
        $grid->column('code', __('Code'));
        $grid->column('title', __('标题'));
        $grid->column('path', __('路径'));
        $grid->column('create_at', __('创建时间'))->display(function(){
            return date('y-m-d H:i',$this->create_at);
        });
        $grid->column('update_at', __('更新时间'))->display(function(){
            return date('y-m-d H:i',$this->update_at);
        });

        $grid->actions(function($actions){
            $actions->disableEdit();
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->disableCreateButton();

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
        $show = new Show(QorLanguages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sort', __('admin.Sort'));
        $show->field('tag', __('Tag'));
        $show->field('code', __('Code'));
        $show->field('title', __('Title'));
        $show->field('path', __('Path'));
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
        $form = new Form(new QorLanguages());

        $form->switch('sort', __('admin.Sort'));
        $form->text('tag', __('Tag'));
        $form->text('code', __('Code'));
        $form->text('title', __('Title'));
        $form->text('path', __('Path'));
        $form->number('create_at', __('admin.Create at'));
        $form->number('update_at', __('admin.Update at'));

        return $form;
    }
}
