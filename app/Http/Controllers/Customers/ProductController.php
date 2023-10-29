<?php

namespace App\Http\Controllers\Customers;

use App\Models\Alergi;
use App\Models\Categories;
use App\Models\DetailProduk;
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
        $categories = Categories::all();
        $productsSeller = ProductSeller::all();
        // dd($productsSeller);
        $products = Product::all();
        $search = $request->search;
        // mengambil data dari table pegawai sesuai pencarian data
        // $products = DB::table('products')
        //     ->where('name', 'like', "%" . $search . "%")
        //     ->paginate();
        return view('customers.products.products', compact('productsSeller', 'products', 'categories'));
    }
    public function detailProductSeller($id, $idProduct, $userID)
    {
        // FUNCTION INI UNTUK MENAMPILKAN DETAIL PRODUK YG SUDAH ADA PENJUALNYA 
        $userSaldo = Auth::user()->saldo;
        $productsSeller = ProductSeller::select('*')
            ->where('id', '=', $id)
            ->where('product_id', '=', $idProduct)
            ->where('user_id', '=', $userID)
            ->first();
        $products = Product::whereId($idProduct)->first();
        // $dataJson = json_encode($productsSeller->size);
        // $datacode = str_replace(array(','), array(''), $productsSeller->size);
        // $datacodeExplode = explode(',', $datacode);

        // $dataJson = json_encode($datacodeExplode);
        // dd($datacodeExplode);
        // $setArray += json_encode($productsSeller->size);
        // print_r($size);
        // $getProductSize = implode(",", $push);
        // dd($productsSeller);
        $getReviews = Review::whereProductId($idProduct)->get();
        $countReviews = Review::whereProductId($idProduct)->count();
        // $wishlist = Wishlist::all();
        return view('customers.products.detail-products-seller', compact('productsSeller', 'userSaldo','products', 'countReviews', 'getReviews'));
    }
    public function detail($id)
    {
        // MENAMPILKAN PRODUK YG BELUM ADA PENJUALNYA
        $products = Product::find($id);

        $productsIsAlreadySell = ProductSeller::whereProductId($id)->first();
        // dd($productsIsAlreadySell);

        // $loopIsSell = '';
        // $loopUser = '';
        // foreach ($productsIsAlreadySell as $is_sell) {
        //     $loopIsSell = $is_sell->product_id;
        //     $loopUser = $is_sell->user_id;
        // }
        // dd($loopUser);
        $getReviews = Review::whereProductId($id)->get();
        $countReviews = Review::whereProductId($id)->count();
        // $wishlist = Wishlist::all();
        return view('customers.products.detail-products', compact('products', 'countReviews', 'getReviews', 'productsIsAlreadySell'));
    }
    public function storeProductSeller(Request $request)
    {
        ProductSeller::create([
            'product_id' => $request->productID,
            'user_id' => $request->userID,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
        ]);
        return redirect()->back()->with('success', 'Product berhasil ditambahkan');
    }
    public function infoProduct(Request $request)
    {
        $product = Product::get();
        return view('customers.products.informasi-produk', compact('product'));
    }
    public function addToWishlist(Request $request)
    {
        $user = Auth::user()->id;
        Wishlist::create([
            'user_id' => $user,
            'product_id' => $request->id,
        ]);

        return redirect('/wishlist')->with('success', 'Produk berhasil ditambahkan kedalam wishlist');
    }
}
