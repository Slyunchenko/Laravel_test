<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Woo\GridView\DataProviders\EloquentDataProvider;

class MainController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
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

        return redirect('/');

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

        return redirect('/');
    }

    public function delCategory($id)
    {
        ProductCategory::query()->where('category_id', '=', $id)->delete();

        return redirect('/');
    }
    public function product(Request $request)
    {
        $product = new EloquentDataProvider(Products::search($request->query()));
        $categories = ProductCategory::all();

        return view('product', compact('product', 'categories'));
    }

    public function createProduct()
    {
        $categories = ProductCategory::all();
        return view('create_product', compact('categories'));
    }

    public function editProduct(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $model = Products::query()->find($id);

            if ($model) {
                $model->setAttribute('product_name', $request->input('product_name'));
                $model->setAttribute('product_description', $request->input('product_description'));
                $model->setAttribute('product_price', $request->input('product_price'));
                $model->setAttribute('category_id', $request->input('category_id'));
                $model->save();
            }

            return redirect('/product');
        }

        $categories = ProductCategory::all();
        $model = Products::query()->find($id)->getAttributes();

        return view('product_update', compact('model', 'categories'));
    }

    public function delProduct($id)
    {
        Products::query()->where('product_id', '=', $id)->delete();

        return redirect('/product');
    }
    public function createProduct_check(Request $create)
    {
        $valid = $create->validate([
            'product_name' => 'required|max:30',
            'product_description' =>'required|max:60',
            'product_price' => 'required|numeric'
        ]);

        $product = new Products();
        $product->product_name = $create->input('product_name');
        $product->product_description = $create->input('product_description');
        $product->product_price = $create->input('product_price');
        $product->category_id = $create->input('category');

        $product->save();

        return redirect('/product');

    }

}
