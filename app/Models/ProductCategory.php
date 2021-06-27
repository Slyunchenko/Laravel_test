<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductCategory extends Model
{

    use HasFactory;

    protected $table = 'product_category';
    protected $primaryKey = 'category_id';

    public static function search(Request $request): Builder
    {
        $query = static::query()
            ->select([
                'product_category.created_at',
                'product_category.category_name',
                'product_category.category_description',
                'product_category.category_id'
            ])
            ->selectRaw('COUNT(products.product_id) as count, SUM(products.product_price) as summa')
            ->leftJoin('products', 'product_category.category_id', '=', 'products.category_id')
            ->groupBy('product_category.category_id');
        if ($request->input('sort') === null) {
            $query->orderByDesc('product_category.created_at');
        }
        if ($search = $request->input('search')) {
            $query->where('category_name', 'like', $search)
                ->orWhere('category_description', 'like', $search);

        }
        $minSum = $request->input('minSum', null);
        $maxSum = $request->input('maxSum', null);
        if ($minSum && $maxSum) {
            $query->havingBetween('summa', [$minSum, $maxSum]);
        } elseif ($minSum) {
            $query->having('summa', '>=', $minSum);
        } elseif ($maxSum) {
            $query->having('summa', '<=', $maxSum);
        }
        $minQty = $request->input('minQty', null);
        $maxQty = $request->input('maxQty', null);
        if ($minQty && $maxQty) {
            $query->havingBetween('count', [$minQty, $maxQty]);
        } elseif ($minQty) {
            $query->having('count', '>=', $minQty);
        } elseif ($maxQty) {
            $query->having('count', '<=', $maxQty);
        }
        return $query;
    }

}
