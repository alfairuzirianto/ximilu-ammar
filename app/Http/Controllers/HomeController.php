<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mendapatkan gambar dari table products
        $products = Product::all();
        return view('public.home', compact('products'));
    }
}
