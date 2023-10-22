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

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::all();
        if (Auth::check()) {
            $userAlergi = Auth::user()->alergi_id;
        }
        $userAlergi = "";
        $alergi = Alergi::get();
        $products = Product::when(
            $request->filter_alergi !=  null,
            function ($q) use ($request) {
                return $q->where('alergi_id', '!=', $request->filter_alergi);
            },
            // // for second select
            // function ($q) use ($request) {
            //     return $q->where('harga', $request);
            // }
        )->when(
            $request->filter2 !=  null,
            function ($q) use ($request) {
                if ($request->filter2 == 'Termurah') {
                    return $q->orderBy('harga', 'asc');
                } else if ($request->filter2 == 'Termahal') {
                    return $q->orderBy('harga', 'desc');
                } else if ($request->filter2 == 'Terlaris') {
                    return $q->orderBy('terjual', 'desc');
                } else if ($request->filter2 == 'BestRating') {
                    return $q->orderBy('jumlah_penilaian', 'desc');
                }
            },
        )->get();

        return view('customers.products.products', compact('products', 'categories', 'userAlergi', 'alergi'));
    }
    public function detail($id)
    {
        $getId = $id;
        $products = Product::find($id);
        $getReviews = Review::whereProductId($id)->get();
        $countReviews = Review::whereProductId($id)->count();
        $wishlist = Wishlist::all();
        return view('customers.products.detail-products', compact('products', 'wishlist', 'countReviews', 'getReviews'));
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
