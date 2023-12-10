<?php

namespace App\Http\Controllers\Customers;

use App\Models\City;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductSeller;
use App\Models\Province;
use App\Models\Returns;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatPesananController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $orders = Order::whereUsersId($user)->orderBy('id', 'Desc')->get();
        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;
        $city  = City::whereId($getUsersCity)->first();
        $province  = Province::whereId($getUsersProvince)->first();
        $fullAddress = '';
        if (Auth::user()->address != null) {
            $fullAddress = Auth::user()->address . ', ' . $city->name . ', ' . $province->name;
        }
        $allCities = City::all();
        $allProvince = Province::all();
        return view('customers.riwayat.index', compact('orders', 'fullAddress', 'getUsersCity', 'getUsersProvince', 'city', 'province', 'allCities', 'allProvince'));
    }
    public function detailsOrder($id)
    {
        $getIdOrder = $id;
        $orderDetails = OrderDetail::whereOrderId($id)->get();
        $getOrderDetail = OrderDetail::whereOrderId($id)->first();
        $getReviewById = Review::whereProductId($getOrderDetail->product_id)->first();
        // dd($getOrderDetail->product_id);
        $sellerID = ProductSeller::whereProductId($getOrderDetail->product_id)->first();
        $getSellerId = $sellerID->user_id;
        // dd($getOrderDetail);
        // dd($getOrderDetail->order->users_id); // user id PABLO A.K.A PEMBELI
        // dd($getOrderDetail->order->users_id); // user id PABLO A.K.A PEMBELI
        $mytime = Carbon::now()->today()->toDateTimeString();

        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;

        $city  = City::whereId($getUsersCity)->first('name');
        $province  = Province::whereId($getUsersProvince)->first('name');

        // return dd($reviews);
        $mytime = Carbon::now()->today()->toDateTimeString();
        return view('customers.riwayat.detail-orders', compact('getIdOrder', 'getReviewById', 'getSellerId', 'orderDetails', 'city', 'mytime',  'province', 'getOrderDetail', 'mytime'));
    }

    // public function storeReturns(Request $request, $id)
    // {
    //     // return dd($request->all());

    //     if ($request->bukti != null) {
    //         $destinationPath = '/images';
    //         $request->bukti->move(public_path($destinationPath), $request->bukti->getClientOriginalName());
    //         Returns::create([
    //             'orders_id' => $request->order_id,
    //             'tanggal' => Carbon::now(),
    //             'alasan' => $request->alasan,
    //             'bukti' => $request->bukti->getClientOriginalName(),

    //         ]);
    //         Order::where('id', $id)
    //             ->update(
    //                 [
    //                     'status' => 'Proses Pengembalian'
    //                 ]
    //             );
    //         // return dd($returns);

    //     }
    //     return redirect()->back()->with('Success', 'Ajuan pengembalian telah dikirim');
    // }
    // public function storeReturnsBack($id)
    // {
    //     Order::where('id', $id)
    //         ->update(
    //             [
    //                 'status' => 'Pesanan Dikirim Balik Kepada Penjual'
    //             ]
    //         );
    //     return redirect('riwayat-pesanan');
    // }


    public function storeReview(Request $request, $id)
    {
        $user = Auth::user()->id;
        $getReview = Review::all();
        // dd($getReview);
        // dd($request->all());
        Review::create([
            'user_id' => $user,
            'product_id' => $id,
            'date' => Carbon::now(),
            'comment' => $request->comments,
            'rating' => $request->ratings,
        ]);
        return redirect('riwayat-pesanan');
    }

    // public function remove($id)
    // {
    //     Order::where('id', $id)->delete();
    //     return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    // }
}
