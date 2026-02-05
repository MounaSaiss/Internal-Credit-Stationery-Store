<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('stock' ,'>',0)->latest()->paginate(12);
        return view('shop.index', compact('products'));
    }
}
