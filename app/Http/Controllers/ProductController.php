<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products');
    }

    public function fetchProduct()
    {
        $product = Product::get();

        return response()->json($product);
    }

    public function store(Request $request)
    {
        Product::create([
            "nama" => $request->nama,
            "harga" => $request->harga,
            "stock" => $request->stock,
        ]);
    }

    public function show($id)
    {

        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->stock = $request->stock;
        $product->save();
    }

    public function destroy($id)
    {

        $product = Product::find($id);
        $product->delete();
    }
}
