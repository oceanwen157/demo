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

        $grid->column('id',__('Id'));
        $grid->column('sort',__('admin.Sort'));
        $grid->column('tag',__('admin.Tag'));
        $grid->column('code',__('admin.Code'));
        $grid->column('title',__('admin.Title'));
        $grid->column('path',__('admin.Path'));
        $grid->column('create_at', __('admin.Create at'))->display(function () {
            return date('y-m-d H:i', $this->create_at);
        });
        $grid->column('update_at', __('admin.Update at'))->display(function () {
            return date('y-m-d H:i', $this->update_at);
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

        $show->field('id',__('admin.Id'));
        $show->field('sort',__('admin.Sort'));
        $show->field('tag',__('admin.Tag'));
        $show->field('code',__('admin.Code'));
        $show->field('title',__('admin.Title'));
        $show->field('path',__('admin.Path'));
        $show->field('create_at',__('admin.Create at'));
        $show->field('update_at',__('admin.Update at'));

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

        $form->switch('sort',__('admin.Sort'));
        $form->text('tag',__('admin.Tag'));
        $form->text('code',__('admin.Code'));
        $form->text('title',__('admin.Title'));
        $form->text('path',__('admin.Path'));
        $form->number('create_at',__('admin.Create at'));
        $form->number('update_at',__('admin.Update at'));

        return $form;
    }
}
