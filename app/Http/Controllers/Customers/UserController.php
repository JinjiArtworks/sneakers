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

    public function switchToBuyer()
    {
        $user = Auth::user()->id;
        // return dd($product);
        User::where('id', $user)
            ->update(
                [
                    'role_id' => 3, // buyer or customers
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
                    'role_id' => 2, //sellers
                ]
            );
        return redirect('/')->with('success');
    }
    public function topUpSaldo(Request $request)
    {
        $user = Auth::user()->id;
        $userSaldo = Auth::user()->saldo;
        // return dd($product);
        User::where('id', $user)
            ->update(
                [
                    'saldo' => $userSaldo + $request->saldo
                ]
            );
        return redirect('/')->with('success');
    }
}
