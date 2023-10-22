<?php

namespace App\Http\Controllers\Customers;

use App\Models\Categories;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Province;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        // return dd($wishlist->product->gambar);
        $getWishlist = Wishlist::Select(
            "wishlists.product_id"
        )
            ->groupBy('product_id')
            ->where('user_id', '=', $user)
            ->get();
        // return dd($getWishlist);
        // $getWishlist = DB::table('wishlists')
        //     ->select('product_id')
        //     ->groupBy('product_id')
        //     ->where('user_id', '=', $user)
        //     ->get();
        // return dd($getWishlist);
        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;
        $city  = City::whereId($getUsersCity)->first('name');
        $province  = Province::whereId($getUsersProvince)->first('name');
        $allCities = City::all();
        $allProvince = Province::all();
        return view('customers.wishlist.index', compact( 'getWishlist', 'getUsersCity', 'getUsersProvince', 'city', 'province', 'allCities', 'allProvince'));
    }
    public function destroy(Request $request)
    {
        // return dd($request->all());
        Wishlist::where('product_id', $request->products)->delete();
        return redirect()->back();
    }
}
