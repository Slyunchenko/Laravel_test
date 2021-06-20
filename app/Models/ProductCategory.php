<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductCategory extends Model
{

    use HasFactory;

    protected $table='product_category';
    protected $primaryKey = 'category_id';

    public static function search($params): Builder
    {
        $query = static::query();

        return $query;
    }

}
