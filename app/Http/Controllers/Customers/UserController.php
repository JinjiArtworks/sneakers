<?php

namespace App\Http\Controllers\Customers;

use App\Models\Categories;
use App\Models\DetailProduk;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    public function switchToBuyer()
    {
        $user = Auth::user()->id;
        // return dd($product);
        User::where('id', $user)
            ->update(
                [
                    'is_seller' => '0',
                ]
            );
        return redirect('/')->with('success');
    }
    public function switchToSeller()
    {
        $user = Auth::user()->id;
        // return dd($product);
        User::where('id', $user)
            ->update(
                [
                    'is_seller' => '1',
                ]
            );
        return redirect('/')->with('success');
    }
}
