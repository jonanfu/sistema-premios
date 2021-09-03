<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Client;

class PremiosController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        //dd($products);
        return view('premios.index', compact('products'));
    }

    public function consultarPuntos(Request $request)
    {
        dd($request);
        $puntos = Client::where('cedula', $request->cedula);
        
        //return
        return $puntos;
    }
}