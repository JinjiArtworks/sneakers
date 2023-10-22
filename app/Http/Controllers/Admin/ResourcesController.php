<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.listResources.index', compact('products'));
    }
    
    // // Add products
    // public function create()
    // {
    //     $product = Product::all();
    //     $categories = Categories::all();
    //     $coupons = Coupon::all();
    //     // return dd($categories);
    //     return view('admin.listProduct.create', compact('product', 'categories','coupons'));
    // }
    // public function store(Request $request)
    // {
    //     if ($request->productImage != null) {
    //         $destinationPath = '/images';
    //         $request->productImage->move(public_path($destinationPath), $request->productImage->getClientOriginalName());
    //         Product::create([
    //             'nama' => $request->productName,
    //             'deskripsi' => $request->productDesc,
    //             'harga' => $request->productPrice,
    //             'stok' => $request->productStock,
    //             'ukuran' => $request->productSize,
    //             'berat' => $request->productWeight,
    //             'categories_id' => $request->productCategories,
    //             'coupons_id' => $request->productCoupon,
    //             'gambar' => $request->productImage->getClientOriginalName(),
    //             'terjual' => 0,
    //             'diskon' => $request->productDisc,
    //         ]);
    //     }
    //     return redirect('/admin-products')->with('success', 'Product berhasil ditambahkan');
    // }
    // public function edit($id)
    // {
    //     $products = Product::find($id);
    //     $categories = Categories::all();
    //     $coupons = Coupon::all();
    //     $getCouponsProducts = Coupon::whereId($products->coupons_id)->first();
    //     return view('admin.listProduct.edit', compact('products', 'categories','coupons','getCouponsProducts'));
    // }
    // public function update(Request $request, $id)
    // {
    //     $destinationPath = '/images';
    //     $request->productImage->move(public_path($destinationPath), $request->productImage->getClientOriginalName());
    //     Product::where('id', $id)
    //         ->update(
    //             [
    //                 'nama' => $request->productName,
    //                 'deskripsi' => $request->productDesc,
    //                 'harga' => $request->productPrice,
    //                 'stok' => $request->productStock,
    //                 'ukuran' => $request->productSize,
    //                 'berat' => $request->productWeight,
    //                 'categories_id' => $request->productCategories,
    //                 'coupons_id' => $request->productCoupon,
    //                 'gambar' => $request->productImage->getClientOriginalName(),
    //                 'terjual' => 0,
    //                 'diskon' => $request->productDisc,
    //             ]
    //         );
    //     return redirect('/admin-products')->with('success', 'Product berhasil diubah.');
    // }
    // public function destroy($id)
    // {
    //     Product::where('id', $id)->delete();
    //     return redirect()->back()->with('success', 'Product berhasil dihapus.');
    // }
}
