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
        $orders = Order::whereUsersId($user)->get();
        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;
        $city  = City::whereId($getUsersCity)->first();
        $province  = Province::whereId($getUsersProvince)->first();

        $fullAddress = Auth::user()->address . ', ' . $city->name . ', ' . $province->name;
        $allCities = City::all();
        $allProvince = Province::all();
        return view('customers.riwayat.index', compact('orders', 'fullAddress', 'getUsersCity', 'getUsersProvince', 'city', 'province', 'allCities', 'allProvince'));
    }
    public function detailsOrder($id)
    {
        $getIdOrder = $id;
        $orderDetails = OrderDetail::whereOrderId($id)->get();
        $getOrderDetail = OrderDetail::whereOrderId($id)->first();
        // dd($getShippingCost);
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
        return view('customers.riwayat.detail-orders', compact('getIdOrder', 'getSellerId', 'orderDetails', 'city', 'mytime',  'province', 'getOrderDetail', 'mytime'));
    }
    public function acceptOrder(Request $request, $id)
    {
        $mytime = Carbon::now()->today()->toDateTimeString();
        // $customerId = Auth::user()->id;
        // $customerSaldo = Auth::user()->saldo;
        $getOrderDetail = OrderDetail::whereOrderId($id)->first();
        $getShippingCost = $getOrderDetail->order->shipping_cost;
        $getTotalPrice = $getOrderDetail->order->total;
        // $getSellerSaldo = $getOrderDetail->order->users->saldo;
        // $getSellerId = $getOrderDetail->order->sellers_id;


        $sellerIdReq = $request->sellerID;
        $sellerID = ProductSeller::whereUserId($sellerIdReq)->first();
        $getSellerId = $sellerID->user_id;
        $getSellerSaldo = $sellerID->user->saldo;
        // dd($getSellerSaldo);
        $getAdmin = User::whereRoleId(1)->first();
        $adminId = $getAdmin->id;
        $adminSaldo = $getAdmin->saldo;

        Order::where('id', $id)
            ->update(
                [
                    'status' => 'Selesai',
                    'updated_at' => $mytime
                ]
            );
        // User::where('id', $customerId)
        //     ->update(
        //         [
        //             'saldo' => $customerSaldo - $getTotalPrice,
        //         ]
        //     );


        // INI MASI SALAH SEDIKIT BAGIAN SALDO SELLERNYA !!!!!!
        User::where('id', $getSellerId)
            ->update(
                [
                    'saldo' => $getSellerSaldo + ($getTotalPrice - $getShippingCost) - 10000,
                ]
            );
        User::where('id', $adminId)
            ->update(
                [
                    // menambahkan biaya layanan admin sebesar 10k
                    'saldo' => $adminSaldo + 10000,
                ]
            );
        return redirect('riwayat-pesanan');
    }

    public function storeReturns(Request $request, $id)
    {
        // return dd($request->all());

        if ($request->bukti != null) {
            $destinationPath = '/images';
            $request->bukti->move(public_path($destinationPath), $request->bukti->getClientOriginalName());
            Returns::create([
                'orders_id' => $request->order_id,
                'tanggal' => Carbon::now(),
                'alasan' => $request->alasan,
                'bukti' => $request->bukti->getClientOriginalName(),

            ]);
            Order::where('id', $id)
                ->update(
                    [
                        'status' => 'Proses Pengembalian'
                    ]
                );
            // return dd($returns);

        }
        return redirect()->back()->with('Success', 'Ajuan pengembalian telah dikirim');
    }
    public function storeReturnsBack($id)
    {
        Order::where('id', $id)
            ->update(
                [
                    'status' => 'Pesanan Dikirim Balik Kepada Penjual'
                ]
            );
        return redirect('riwayat-pesanan');
    }


    public function reviewPages($id)
    {
        $getIdOrder = $id;
        $reviews = Review::all();
        // return dd($reviews->product_id);
        $user = Auth::user()->id;
        // $checkOrdersComplete = Order::where('status', '=', 'Selesai')->orWhere('status','=','Ajuan Pengembalian Ditolak')->get();

        $orderDetails = OrderDetail::whereProductId($id)->first();
        return view('customers.riwayat.send-review', compact('orderDetails', 'getIdOrder', 'reviews'));
    }
    public function storeReview(Request $request, $id)
    {
        $user = Auth::user()->id;
        $getProducts = Review::whereProductId($id)->first();
        // return dd($getProducts->product->nama);
        Review::create([
            'user_id' => $user,
            'tanggal' => Carbon::now(),
            'komentar' => $request->comment,
            'rating' => $request->rating,
            'product_id' => $id,
        ]);
        Product::where('id', $id)
            ->update(
                [
                    'jumlah_penilaian' => $getProducts->product->jumlah_penilaian + 1,
                ]
            );
        return redirect('riwayat-pesanan');
    }

    // public function remove($id)
    // {
    //     Order::where('id', $id)->delete();
    //     return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    // }
}
