<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Woo\GridView\DataProviders\EloquentDataProvider;

class ProductController extends Controller
{
    public function product(Request $request)
    {
        $product = new EloquentDataProvider(Products::search($request));
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
