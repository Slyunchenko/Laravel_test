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
}
