<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class PremiosController extends Controller
{
    public function index() 
    {
        $products = Product::get();
        return view('premios.index', compact('products'));
    }
}
