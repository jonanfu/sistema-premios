<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.create', compact('categories', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('picture') != null){
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image"),$image_name);
        }
        $product = Product::create($request->all()+[
            'image' =>$image_name,
        ]);
        
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.edit', compact('product', 'categories', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($request->file('picture') != null){
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image"), $image_name);
        }
        $product->update($request->all()+[
            'image' => $image_name,
        ]);
        
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
    
    public function change_status(Product $product)
    {
        if ($product->status == 'ACTIVE') {
            $product->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } else {
            $product->update(['status' => 'ACTIVE']);
            return redirect()->back();
        }
    }

    
    public function get_products_by_id(Request $request){
        if ($request->ajax()){
            $products = Product::findOrFail($request->product_id);
            
            return response()->json($products);
        }
    }



}
