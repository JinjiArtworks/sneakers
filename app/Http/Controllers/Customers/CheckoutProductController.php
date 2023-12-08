<?php

namespace App\Http\Controllers\Customers;

use App\Models\City;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductSeller;
use App\Models\Province;
use App\Models\User;
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
        // $user = Auth::user();
        $cart = session()->get('cart');
        $userAddress = Auth::user()->address;
        $sellers_id = $request->sellers_id; // get sellers id
        // dd($sellers_id);
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
        } else {
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
        $grandTotal =  $request->total + $cekongkir;

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
        return view('customers.cart.checkout', ['snap_token' => $snapToken],  compact('cart', 'cekongkir', 'cityName', 'getServices', 'provinceName', 'userAddress', 'sellers_id', 'getUsersProvince', 'getUsersCity'));
        // return view('customers.cart.checkout',  compact('cart', 'cityName', 'getServices', 'provinceName', 'userAddress', 'getUsersProvince', 'getUsersCity'));
    }

    public function store(Request $request)
    {
        // if (Auth::attempt(['email' != null])) {
        // Authentication was successful...
        $user = Auth::user();
        // return dd($request->all());
        $json = json_decode($request->get('json'));
        $cart = session()->get('cart');
        $orders = new Order();
        $orders->users_id = $user->id;
        $orders->name = $user->name;
        $orders->phone = $user->phone;
        $orders->address = $user->address;
        $orders->date = Carbon::now();
        $orders->sellers_id = $request->sellers_id;
        $orders->shipping_cost = $request->ongkos_kirim;
        $orders->status = 'Proses Validasi Admin';
        $orders->ekspedisi = $request->courierService;
        $orders->total = $request->grandTotal;
        $orders->save();
        foreach ($cart as $item) {
            // dd($cart);
            $details = new OrderDetail();
            $details->product_id = $item['product_id'];
            $details->order_id = $orders->id;
            $details->quantity = $item['quantity'];
            $details->price = $item['price'];
            $details->save();
            $product = Product::find($item['product_id']);
            // return dd($product);
            $product::where('id', $item['product_id'])
                ->update(
                    [
                        // 'stock' => $product["stock"] - $item["quantity"],
                        'sold' => $product["sold"] + $item["quantity"],
                    ]
                );
            $usersSaldo = User::find($item['user_id']);
            $usersSaldo::where('id', $item['user_id'])
                ->update(
                    [
                        'saldo' => $usersSaldo["saldo"] - $request->grandTotal,
                    ]
                );

            $adminSaldo = User::whereRoleId($item['admin_id'])->first();
            // dd($item['admin_id']);
            User::where('id', $item['admin_id'])
                ->update(
                    [
                        'saldo' => $adminSaldo->saldo + $request->grandTotal,
                    ]
                );
            $productSeller = ProductSeller::whereProductId($item['product_id'])->first();
            // dd($productSeller->stock);
            ProductSeller::where('product_id', $item['product_id'])
                ->update(
                    [
                        'stock' => $productSeller->stock -  $item["quantity"],
                    ]
                );
        }
        session()->forget('cart');
        return redirect('/riwayat-pesanan')->with('success', 'Produk berhasil di order');
        // }
    }
}
