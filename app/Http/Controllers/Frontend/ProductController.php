<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_active', true)->get();
        return view('frontend.products.index', compact('products'));
    }
    
    public function show($slug)
    {
        $product = Product::with('brand')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where(function($q) use ($product) {
                $q->where('category', $product->category)
                  ->orWhere('brand_id', $product->brand_id);
            })
            ->limit(4)
            ->get();
        
        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}