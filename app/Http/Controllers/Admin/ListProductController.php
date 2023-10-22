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
        $coupons = Coupon::all();
        $alergi = Alergi::all();
        // return dd($categories);
        return view('admin.listProduct.create', compact('product', 'categories', 'coupons', 'alergi'));
    }
    public function store(Request $request)
    {
        if ($request->productImage != null) {
            $destinationPath = '/images';
            $request->productImage->move(public_path($destinationPath), $request->productImage->getClientOriginalName());
            Product::create([
                'nama' => $request->productName,
                'usia' => $request->usia,
                'deskripsi' => $request->productDesc,
                'harga' => $request->productPrice,
                'stok' => $request->productStock,
                'ukuran' => $request->productSize,
                'berat' => $request->productWeight,
                'alergi_id' => $request->productAlergi,
                'categories_id' => $request->productCategories,
                'gambar' => $request->productImage->getClientOriginalName(),
                'terjual' => 0,
                'diskon' => $request->productDisc,
                'brand' => $request->productBrand,
                'bahan' => $request->productBahan,
            ]);
        }
        return redirect('/admin-products')->with('success', 'Product berhasil ditambahkan');
    }
    public function edit($id)
    {
        $products = Product::find($id);
        $categories = Categories::all();
        $alergi = Alergi::all();
        $coupons = Coupon::all();
        $getCouponsProducts = Coupon::whereId($products->coupons_id)->first();
        return view('admin.listProduct.edit', compact('products', 'categories', 'coupons', 'getCouponsProducts', 'alergi'));
    }
    public function update(Request $request, $id)
    {
        if ($request->productImage != null) {
            $destinationPath = '/images';
            $request->productImage->move(public_path($destinationPath), $request->productImage->getClientOriginalName());
            Product::where('id', $id)
                ->update(
                    [
                        'nama' => $request->productName,
                        'deskripsi' => $request->productDesc,
                        'usia' => $request->usia,
                        'harga' => $request->productPrice,
                        'stok' => $request->productStock,
                        'ukuran' => $request->productSize,
                        'berat' => $request->productWeight,
                        'alergi_id' => $request->productAlergi,
                        'categories_id' => $request->productCategories,
                        'gambar' => $request->productImage->getClientOriginalName(),
                        'terjual' => 0,
                        'diskon' => $request->productDisc,
                        'brand' => $request->productBrand,
                        'bahan' => $request->productBahan,
                    ]
                );
        }
        else{
            return redirect()->back();
        }
        return redirect('/admin-products')->with('success', 'Product berhasil diubah.');
    }
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product berhasil dihapus.');
    }
}
