<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Woo\GridView\DataProviders\EloquentDataProvider;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $provider = new EloquentDataProvider(ProductCategory::search($request->query()));

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
        return redirect('/');

    }

    public function editCategory($id)
    {
        $model = ProductCategory::query()->where('category_id', '=', $id);

        return view('category_form', compact('model'));
    }

    public function delCategory($id)
    {
        ProductCategory::query()->where('category_id', '=', $id)->delete();

        return redirect('/');
    }
}
