<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alergi;
use App\Models\Bahan;
use App\Models\Categories;
use App\Models\Coupon;
use App\Models\Models;
use App\Models\Motif;
use App\Models\Product;
use App\Models\Teknik;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.listProduct.index', compact('products'));
    }
    public function details($id)
    {
        $products = Product::whereId($id)->first();
        return view('admin.listProduct.details-product', compact('products'));
    }
    // Add products
    public function create()
    {
        $product = Product::all();
        $categories = Categories::all();
        // return dd($categories);
        return view('admin.listProduct.create', compact('product', 'categories'));
    }
    public function store(Request $request)
    {
        if ($request->images != null) {
            $destinationPath = '/img/list';
            $request->images->move(public_path($destinationPath), $request->images->getClientOriginalName());
            Product::create([
                'name' => $request->products,
                'images' => $request->images->getClientOriginalName(),
                'categories_id' => $request->categories,
                // 'price' => $request->price,
                'stock' => $request->stock,
                'brand' => $request->brand,
                // 'size' => $request->size,
                'weight' => $request->weight,
                'description' => $request->description,
                'discount' => $request->discount,
                'sold' => 0,
            ]);
        }
        return redirect('/admin-products')->with('success', 'Product berhasil ditambahkan');
    }
    public function edit($id)
    {
        $products = Product::find($id);
        $categories = Categories::all();
        return view('admin.listProduct.edit', compact('products', 'categories'));
    }
    public function update(Request $request, $id)
    {
        if ($request->images != null) {
            $destinationPath = '/img/list';
            $request->images->move(public_path($destinationPath), $request->images->getClientOriginalName());
            Product::where('id', $id)
                ->update(
                    [
                        'name' => $request->products,
                        'images' => $request->images->getClientOriginalName(),
                        'categories_id' => $request->categories,
                        // 'price' => $request->price,
                        'stock' => $request->stock,
                        'brand' => $request->brand,
                        // 'size' => $request->size,
                        'weight' => $request->weight,
                        'description' => $request->description,
                        'discount' => $request->discount,
                        'sold' => 0,
                    ]
                );
        } else {
            return redirect()->back()->with('error', 'Product gagal diubah');
        }
        return redirect('/admin-products')->with('success', 'Product berhasil diubah.');
    }
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product berhasil dihapus.');
    }
}
