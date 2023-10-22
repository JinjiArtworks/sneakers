<?php

namespace App\Http\Controllers\Customers;

use App\Models\City;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use League\Flysystem\Config;

class CheckoutProductController extends Controller
{
    public function index(Request $request)
    {
        // return dd($request->all());
        $user = Auth::user();
        $cart = session()->get('cart');
        $getCoupon = $request->coupon;
        $userAddress = Auth::user()->address;
        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;
        $cityName  = City::whereId($getUsersCity)->first('name');
        $provinceName  = Province::whereId($getUsersProvince)->first('name');
        $getServices = $request->service;
        if ($request->courier == 'jne') {
            if ($request->origin && $request->destination && $request->berat && $request->courier && $request->province && $request->service) {
                $origin = $request->origin;
                $destination = $request->destination;
                $weight = $request->berat;
                $courier = $request->courier;
                $province = $request->province;
                $service = $request->service;
                // return dd($service);
                $response = Http::asForm()->withHeaders([
                    'key' => '91f6ce360df9a6e2ca7badaae61f5b78'
                ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier,
                    'province' => $province,
                    'service' => $service,
                ]);
                $okeServices = $response['rajaongkir']['results'][0]['costs'][0]['service'];
                if ($courier == 'jne') {
                    if ($service == 'OKE') {
                        $cekongkir = $response['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
                    } else if ($service == 'REG') {
                        $cekongkir = $response['rajaongkir']['results'][0]['costs'][1]['cost'][0]['value'];
                    }
                }
            } else {
                $origin = '';
                $destination = '';
                $weight = '';
                $courier = '';
                $province = '';
                $cekongkir = null;
            }
        } else  {
            $cekongkir = 0;
        }

        // $userName = $user->name;
        // payment gateway
        \Midtrans\Config::$serverKey = 'SB-Mid-server-yUxga--v_4EQ_EKe8TWMMmbZ';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $grandTotal =  $request->total + $cekongkir - $getCoupon;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $grandTotal,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'phone' => Auth::user()->phone,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($params);
        return view('customers.cart.checkout', ['snap_token' => $snapToken],  compact('cart', 'getCoupon', 'cekongkir', 'cityName', 'getServices', 'provinceName', 'userAddress', 'getUsersProvince', 'getUsersCity'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // return dd($request->all());
        $json = json_decode($request->get('json'));
        $cart = session()->get('cart');
        $orders = new Order();
        $orders->users_id = $user->id;
        $orders->nama = $user->name;
        $orders->no_handphone = $user->phone;
        $orders->alamat = $user->address;
        $orders->tanggal_orders = Carbon::now();
        $orders->ongkos_kirim = $request->ongkos_kirim;
        $orders->status = 'Sedang Diproses';
        if ($request->ongkos_kirim == 0) {
            $orders->ekspedisi = 'Ambil Ditempat';
        } else {
            $orders->ekspedisi = $request->courierService;
        }
        $orders->jenis_pembayaran = $json->payment_type;
        $orders->potongan_kupon = $request->potongan_kupon;
        $orders->total = $request->grandTotal;
        $orders->save();
        foreach ($cart as $item) {
            $details = new OrderDetail();
            $details->product_id = $item['id'];
            $details->order_id = $orders->id;
            $details->qty = $item['quantity'];
            $details->harga = $item['harga'] - $item['diskon'];
            $details->diskon = $item['diskon'];
            $details->save();
            $product = Product::find($item['id']);
            // return dd($product);
            $product::where('id', $item['id'])
                ->update(
                    [
                        'stok' => $product["stok"] - $item["quantity"],
                        'terjual' => $product["terjual"] + $item["quantity"],
                    ]
                );
        }
        session()->forget('cart');
        return redirect('/riwayat-pesanan')->with('success', 'Produk berhasil di order');
    }
}
