<?php

namespace App\Admin\Controllers;

use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->model()->withCount('posts');
        $grid->column('id', __('Id'));
        $grid->column('posts_count', __('Posts Count'));
        $grid->column('slug', __('Slug'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'))->display(function ($value) {
            return Str::limit($value, 50);
        });
        $grid->column('enabled', __('Enabled'))->replace(__('admin.enabled'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('enabled', __('Enabled'))->using(__('admin.enabled'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('slug', __('Slug'));
        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->switch('enabled', __('Enabled'));

        return $form;
    }
}
