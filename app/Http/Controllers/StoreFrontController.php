<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StoreFrontController extends Controller
{
    public function index()
    {
        $products = Product::where('quantity', '>', 0)->get();
        return view('store.index', compact('products'));
    }
}
