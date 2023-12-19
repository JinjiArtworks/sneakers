<?php

namespace App\Http\Controllers\Customers;

use App\Models\Alergi;
use App\Models\Categories;
use App\Models\DetailProduk;
use App\Models\Models;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\ProductSeller;
use App\Models\Review;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Models::all();
        $products = Product::all();
        $productsSeller = ProductSeller::all();
        // dd($productsSeller);
        $search = $request->search;
        // mengambil data dari table pegawai sesuai pencarian data
        // $products = DB::table('products')
        //     ->where('name', 'like', "%" . $search . "%")
        //     ->paginate();
        return view('customers.products.products', compact('productsSeller', 'products', 'categories'));
    }
    public function detailProductIsSell($id, $idProduct, $userID)
    {
        // FUNCTION INI UNTUK MENAMPILKAN DETAIL PRODUK YG SUDAH ADA PENJUALNYA 
        $userSaldo = Auth::user()->saldo;
        $productsSeller = ProductSeller::select('*')
            ->where('id', '=', $id)
            ->where('product_id', '=', $idProduct)
            ->where('user_id', '=', $userID)
            ->first();
        $products = Product::whereId($idProduct)->first();
        $getReviews = Review::whereProductId($idProduct)->get();
        // dd($getReviews);
        $countReviews = Review::whereProductId($idProduct)->count();

        // dd($userProduct);
        // Get all product names from the database
        $allProducts = DB::table('products')->pluck('name')->toArray();
        // Calculate Jaccard coefficient for each product
        $recommendations = [];
        foreach ($allProducts as $product) {
            $coefficient = $this->calculateJaccardCoefficient($idProduct, $product);
            $recommendations[$product] = $coefficient;
        }

        // Sort products based on Jaccard coefficient in descending order
        arsort($recommendations);
        // Get top 4 recommended products
        $topRecommendations = array_slice($recommendations, 0, 4, true);
        $names = array_keys($topRecommendations);
        $convertReccomendation = implode(' ', $names);
        $getRecommendProcut = Product::where('name', 'LIKE', "%$convertReccomendation%")->get();
        // dd($getRecommendProcut);
        return view('customers.products.detail-products-seller', compact('names', 'productsSeller', 'userSaldo', 'products', 'countReviews', 'getReviews'));
    }

    
    private function calculateJaccardCoefficient($product1, $product2)
    {
        $arr1 = str_split(strtolower($product1));
        $arr2 = str_split(strtolower($product2));

        $intersection = array_intersect($arr1, $arr2);
        $union = array_merge($arr1, $arr2);

        return count($intersection) / count($union);
    }



    // Detail product untuk SELLLER MENJUAL PRODUCT
    public function detail($id)
    {
        $products = Product::find($id);
        // dd($products);
        $getReviews = Review::whereProductId($id)->get();
        $countReviews = Review::whereProductId($id)->count();
        return view('customers.products.detail-products', compact('products', 'countReviews', 'getReviews'));
    }
    public function storeProductSeller(Request $request)
    {
        ProductSeller::create([
            'product_id' => $request->productID,
            'user_id' => $request->userID,
            'price' => str_replace('.', '', $request->price),
            'stock' => $request->stock,
            'size' => $request->size,
        ]);
        return redirect()->back()->with('success', 'Product berhasil ditambahkan');
    }
    public function infoProduct(Request $request)
    {
        $product = Product::get();
        return view('customers.products.informasi-produk', compact('product'));
    }
}
