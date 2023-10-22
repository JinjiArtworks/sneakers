<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Returns;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnOrderController extends Controller
{
    public function index()
    {
        // payment gateway
        $orders = Order::all();
        return view('admin.return.index', compact('orders'));
        // return dd($request->all());
        // <form method="POST" action="{{ route('return.confirm', ['id' => $item->id]) }}"
        // enctype="multipart/form-data" id="submit_form">
        // @csrf
    }
    public function details($id)
    {
        // payment gateway
        $orderdetails = OrderDetail::whereOrderId($id)->get();
        // return dd($orderdetails);
        $getOrderDetails = OrderDetail::whereOrderId($id)->first();
        $returnOrder = Returns::whereOrdersId($id)->first();
        // return dd($getOrderDetails);
        \Midtrans\Config::$serverKey = 'SB-Mid-server-yUxga--v_4EQ_EKe8TWMMmbZ';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // $grandTotal =  $oc->total;
        // $customers =  $oc->nama;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $getOrderDetails->order->total,
            ),
            'customer_details' => array(
                'first_name' => $getOrderDetails->order->nama,
                'phone' => '08111222333',
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('admin.return.details', ['snap_token' => $snapToken], compact('getOrderDetails', 'orderdetails', 'returnOrder'));
        // return dd($request->all());

    }
    public function update(Request $request, $id)
    {
        // return dd($request->grandTotal);

        Order::where('id', $id)
            ->update(
                [
                    'status' => $request->status
                ]
            );

        return redirect('/data-return')->with('success', 'Status pesanan berhasil diubah');
    }
    public function confirmReturn($id)
    {
        $getOrderDetails = OrderDetail::whereOrderId($id)->first();
        $getProductId = $getOrderDetails->product_id;
        $getQty = $getOrderDetails->quantity;

        $getProducts = Product::whereId($getProductId)->first();
        $getStok = $getProducts->stok;
        $getTerjual = $getProducts->terjual;

        Product::where('id', $getProductId)
            ->update(
                [
                    'stok' => $getStok + $getQty,
                    'terjual' => $getTerjual - $getQty,
                ]
            );
        Order::where('id', $id)
            ->update(
                [
                    'status' => 'Pengembalian Diterima Penjual'
                ]
            );
        // Order::where('id', $id)->delete();


        return redirect('/data-return')->with('success', 'Status pesanan berhasil diubah');
    }
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus');
    }
}
