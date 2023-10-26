<?php

namespace App\Http\Controllers\Customers;

use App\Models\Alergi;
use App\Models\Categories;
use App\Models\DetailProduk;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\ProductsSeller;
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
        $productsSeller = ProductsSeller::all();
        $products = Product::all();
        $search = $request->search;
        // mengambil data dari table pegawai sesuai pencarian data
        // $products = DB::table('products')
        //     ->where('name', 'like', "%" . $search . "%")
        //     ->paginate();
        return view('customers.products.products', compact('productsSeller', 'products', 'categories'));
    }
    public function detail($id)
    {
        $productsSeller = ProductsSeller::whereProductId($id)->first();
        $products = Product::whereId($id)->first();
        // implode(",", $dataRaw['facRoomType']),
        // $setArray = [];
        // $setArray .= $productsSeller->size . array_push($setArray);
        // // $setArray += json_encode($productsSeller->size);
        // // print_r($size);
        // $getProductSize = implode(",", $push);
        // dd($getProductSize);

        // dd($productsSeller);
        $getReviews = Review::whereProductId($id)->get();
        $countReviews = Review::whereProductId($id)->count();
        // $wishlist = Wishlist::all();
        return view('customers.products.detail-products', compact('productsSeller', 'products', 'countReviews', 'getReviews'));
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
