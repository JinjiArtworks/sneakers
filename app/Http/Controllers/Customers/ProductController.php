<?php

namespace App\Http\Controllers\Customers;

use App\Models\Alergi;
use App\Models\Categories;
use App\Models\DetailProduk;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
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
        $products = Product::all();
        $search = $request->search;
        // mengambil data dari table pegawai sesuai pencarian data
        $products = DB::table('products')
            ->where('name', 'like', "%" . $search . "%")
            ->paginate();
        return view('customers.products.products', compact('products', 'categories'));
    }
    public function detail($id)
    {
        $products = Product::find($id);

        $getReviews = Review::whereProductId($id)->get();
        $countReviews = Review::whereProductId($id)->count();
        // $wishlist = Wishlist::all();
        return view('customers.products.detail-products', compact('products', 'countReviews', 'getReviews'));
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
