<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Traits\TitleSettable;
use App\Category;
use App\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use Encore\Admin\Widgets\Table;

class PostController extends AdminController
{
    use TitleSettable;

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->model()->withCount('categories');
        $grid->column('id', __('Id'));
        $grid->column('categories_count', __('Categories Count'));
        $grid->column('slug', __('Slug'))->expand(function ($post) {
            return new Table(['language', 'name', 'description'], array_map(function ($locale, $trans) use ($post) {
                return [$trans, $post->name[$locale], Str::limit($post->description[$locale], 50)];
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
        $show = new Show(Post::findOrFail($id));

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
        $form = new Form(new Post());

        $form->listbox('categories', 'Categories')->options(Category::pluck('name', 'id')->map(function ($locales) {
            return $locales[array_key_first(locales())];
        }));
        $form->text('slug', __('Slug'))->rules('required')->required();
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
