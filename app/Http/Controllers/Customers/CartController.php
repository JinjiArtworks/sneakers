<?php

namespace App\Http\Controllers\Customers;

use App\Models\City;
use App\Models\Coupon;
use App\Models\Ekspedisi;
use App\Models\Product;
use App\Models\ProductSeller;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        $user = Auth::user()->id;
        $productSeller = ProductSeller::where('id', '=', $id)->first();
        // $sellers_id = $request->sellers_id;
        // dd($productSeller);
        $cart = session()->get('cart');
        // return dd($cart);
        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $productSeller->id,
                "product_id" => $productSeller->product_id,
                "user_id" => $user,
                "admin_id" => 1,
                "sellers_id" => $productSeller->user_id,
                "name" => $productSeller->product->name,
                "images" => $productSeller->product->images,
                "price" => $productSeller->price,
                "stock" => $productSeller->product->stock,
                "description" => $productSeller->description,
                "weight" => $productSeller->product->weight,
                "models" => $productSeller->product->models->name,
                "size" => $request->size,
                "quantity" => $request->quantity,
                "subtotal" => $productSeller->price * $request->quantity
            ];
        } else {
            if ($cart[$id]['size'] != $request->size) {
                $cart[$id] = [
                    "user_id" => $user,
                    "id" => $productSeller->id,
                    "product_id" => $productSeller->product_id,
                    "admin_id" => 1,
                    "sellers_id" => $productSeller->user_id,
                    "name" => $productSeller->product->name,
                    "images" => $productSeller->product->images,
                    "price" => $productSeller->price,
                    "stock" => $productSeller->product->stock,
                    "description" => $productSeller->description,
                    "weight" => $productSeller->product->weight,
                    "models" => $productSeller->product->models->name,
                    "size" => $request->size,
                    "quantity" => $request->quantity,
                    "subtotal" => $productSeller->price * $request->quantity
                ];
            } else {
                $cart[$id]["weight"] += $productSeller->product->weight;
                $cart[$id]["quantity"] += $request->quantity;
                $cart[$id]["subtotal"] += $productSeller->price * $request->quantity;
            }
        }
        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Sukses menambahkan produk');
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $userName = Auth::user()->name;
        $userPhone = Auth::user()->phone;
        $userAddress = Auth::user()->address;
        // dd($userAddress);
        $sellers_id = $request->sellers_id;

        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;

        $city  = City::whereId($getUsersCity)->first('name');
        $province  = Province::whereId($getUsersProvince)->first('name');
        // Looping for dropdown
        $allCities = City::all();
        $allProvince = Province::all();
        $cart = session()->get('cart');
        // dd($cart);

        // dd($cart);

        if ($cart != null) {
            $countCart = count($cart);
        } else {
            $countCart = 0;
        }
        $ekspedisi = Ekspedisi::all();
        // $kupons = Coupon::all();
        return view('customers.cart.cart', compact('cart', 'sellers_id', 'userPhone', 'userName', 'countCart', 'ekspedisi', 'userAddress', 'getUsersProvince', 'getUsersCity', 'city', 'province', 'allCities', 'allProvince'));
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return redirect('/cart')->with('info', 'Produk berhasil dihapus');
    }
    public function update(Request $request)
    {
        // return dd($request->all());
        $user = Auth::user()->id;
        User::where('id', $user)
            ->update(
                [
                    'address' => $request->address,
                    'city_id' => $request->city,
                    'province_id' => $request->province,
                ]
            );
        return redirect()->back()->with('success', 'Alamat berhasil diubah');
    }
    public function getProvince($id)
    {
        $province = Province::whereId($id)->all();
        return json_encode($province);
    }
    public function getCities($id)
    {
        $cities = City::whereProvinceId($id)->pluck('name', 'id');
        return json_encode($cities);
    }
}
