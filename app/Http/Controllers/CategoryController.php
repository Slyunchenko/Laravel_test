<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Woo\GridView\DataProviders\EloquentDataProvider;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $provider = new EloquentDataProvider(ProductCategory::search($request));

        return view('home', compact('provider'));
    }

    public function createCategory()
    {

        return view('category_form');

    }

    public function createCategory_check(Request $create)
    {
        $valid = $create->validate([
            'category_name' => 'required|max:30',
            'category_description' =>'required|max:60'
        ]);

        $category = new ProductCategory();
        $category->category_name = $create->input('category_name');
        $category->category_description = $create->input('category_description');

        $category->save();

        return redirect('/category');

    }

    public function editCategory($id)
    {
        $model = ProductCategory::query()->find($id)->getAttributes();

        return view('category_update', compact('model'));
    }

    public function edit(Request $request)
    {
        $valid = $request->validate([
            'category_name' => 'required|max:30',
            'category_description' => 'required|max:60'
        ]);

        $model = ProductCategory::query()->find($request->input('category_id'));

        if ($model) {
            $model->setAttribute('category_name', $request->input('category_name'));
            $model->setAttribute('category_description', $request->input('category_description'));
            $model->save();
        }

        return redirect('/category');
    }

    public function delCategory($id)
    {
        ProductCategory::query()->where('category_id', '=', $id)->delete();

        return redirect('/category');
    }

}
