<?php

namespace App\Admin\Controllers;

use App\Models\Food;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FoodController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Food';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Food());

        $grid->column('id', __('Id'));
        $grid->column('store_id', __('Store id'));
        $grid->column('name', __('Name'));
        $grid->column('unit_price', __('Unit price'));
        $grid->column('desc', __('Desc'));

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
        $show = new Show(Food::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('store_id', __('Store id'));
        $show->field('name', __('Name'));
        $show->field('unit_price', __('Unit price'));
        $show->field('desc', __('Desc'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Food());

        $form->number('store_id', __('Store id'));
        $form->text('name', __('Name'));
        $form->number('unit_price', __('Unit price'));
        $form->textarea('desc', __('Desc'));

        return $form;
    }
}
