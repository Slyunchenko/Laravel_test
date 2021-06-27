<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    public static function search(Request $request): Builder
    {
        $query = static::query()->join('product_category', 'products.category_id', '=', 'product_category.category_id')
            ->select([
                'products.created_at',
                'products.category_id',
                'products.product_price',
                'products.product_description',
                'products.product_name',
                'products.product_id',
                'product_category.category_name'
            ]);
        if ($request->input('sort') === null) {
            $query->orderByDesc('products.created_at');
        }
        if ($search = $request->input('search')) {
            $query->where('product_name', 'like', $search)
                ->orWhere('product_description', 'like', $search);
        }
        $minSum = $request->input('minSum', null);
        $maxSum = $request->input('maxSum', null);
        if ($minSum && $maxSum) {
            $query->whereBetween('product_price', [$minSum, $maxSum]);
        } elseif ($minSum) {
            $query->where('product_price', '>=', $minSum);
        } elseif ($maxSum) {
            $query->where('product_price', '<=', $maxSum);
        }

        if ($category_id = $request->input('category')) {
            $query->where('category_id', '=',$category_id);
        }

        return $query;
    }

    public function category()
    {
        return
            $this->hasOne(ProductCategory::class, 'category_id', 'category_id');
    }


}
