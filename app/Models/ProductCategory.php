<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table='product_category';

    public static function search($params): \Illuminate\Database\Eloquent\Builder
    {
        $query = ProductCategory::query();

        return $query;
    }
}
