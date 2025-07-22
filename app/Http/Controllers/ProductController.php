<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index(Request $request) {
        $query=Product::with('productVariants');
 
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->has('min_price') || $request->has('max_price')) {
            $query->whereHas('productVariants', function ($q) use ($request) {
                if ($request->has('min_price')) {
                    $q->where('selling_price', '>=', (int)$request->min_price);
                }
                if ($request->has('max_price')) {
                    $q->where('selling_price', '<=', (int)$request->max_price);
                }
            });
        }

        $limit = $request->input('limit', 10);

        return response()->json(
            $query->paginate($limit)
        );
    }
}