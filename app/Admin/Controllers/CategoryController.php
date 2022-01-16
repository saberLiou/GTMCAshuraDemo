<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Traits\TitleSettable;
use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use Encore\Admin\Widgets\Table;

class CategoryController extends AdminController
{
    use TitleSettable;

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
        $grid->column('slug', __('Slug'))->expand(function ($category) {
            return new Table(['language', 'name', 'description'], array_map(function ($locale, $trans) use ($category) {
                return [$trans, $category->name[$locale], Str::limit($category->description[$locale], 50)];
            }, array_keys($locales = locales()), $locales));
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
        $form->switch('enabled', __('Enabled'));

        foreach (locales() as $locale => $trans) {
            $form->divider($trans);
            $form->hidden(($localePrefix = $locale . '.') . 'locale')->default($locale);
            $form->textarea($localePrefix . 'name', __('Name'));
            $form->textarea($localePrefix . 'description', __('Description'));
            $form->switch($localePrefix . 'active', __('Active'));
        }

        return $form;
    }
}
