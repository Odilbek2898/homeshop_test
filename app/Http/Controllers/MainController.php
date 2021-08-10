<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductsFilterRequest;
use Illuminate\Http\Requests;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
//         dd($request->ip());

        $productsQuery = Product::with('category');

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        foreach (['new', 'hit', 'recommend'] as $field){
            if ($request->has($field)) {
                $productsQuery->$field();
            }
        }


        $products = $productsQuery->paginate(9)->withPath("?" . $request->getQueryString());

        return view('index', compact('products'));
    }

    public function categories()
    {
        $categories = Category::query()->get();
        return view('categories', compact('categories'));
    }

    public function category($code)
    {
        $category =  Category::query()->where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->first();
        return view('product', compact('product'));
    }
}
