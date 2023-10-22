<?php

namespace App\Http\Controllers\Customers;

use App\Models\City;
use App\Models\Coupon;
use App\Models\Ekspedisi;
use App\Models\Product;
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
        $product = Product::find($id);
        $cart = session()->get('cart');
        // return dd($cart);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $product->id,
                "user_id" => $user,
                "nama" => $product->nama,
                "gambar" => $product->gambar,
                "harga" => $product->harga,
                "diskon" => $product->diskon,
                "stok" => $product->stok,
                "alergi" => $product->alergi->nama,
                "deskripsi" => $product->deskripsi,
                "berat" => $product->berat,
                "categories" => $product->categories->nama,
                "size" => $request->size,
                "quantity" => $request->quantity,
                "subtotal" => ($product->harga - $product->diskon)  * $request->quantity
            ];
        } else {
            if ($cart[$id]['size'] != $request->size) {
                $cart[$id] = [
                    "id" => $product->id,
                    "user_id" => $user,
                    "nama" => $product->nama,
                    "gambar" => $product->gambar,
                    "harga" => $product->harga,
                    "diskon" => $product->diskon,
                    "stok" => $product->stok,
                    "alergi" => $product->alergi->nama,
                    "deskripsi" => $product->deskripsi,
                    "berat" => $product->berat,
                    "categories" => $product->categories->nama,
                    "size" => $request->size,
                    "quantity" => $request->quantity,
                    "subtotal" => ($product->harga - $product->diskon)  * $request->quantity
                ];
            } else {
                $cart[$id]["berat"] += $product->berat;
                $cart[$id]["quantity"] += $request->quantity;
                $cart[$id]["subtotal"] += ($product->harga - $product->diskon)  * $request->quantity;
            }
        }
        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Sukses menambahkan produk');
    }
    public function index()
    {
        $user = Auth::user();
        $userAddress = Auth::user()->address;
        $getUsersCity = Auth::user()->city_id;
        $getUsersProvince = Auth::user()->province_id;
        $city  = City::whereId($getUsersCity)->first('name');
        $province  = Province::whereId($getUsersProvince)->first('name');

        $allCities = City::all();
        $allProvince = Province::all();
        $cart = session()->get('cart');
        if ($cart != null) {
            $countCart = count($cart);
        } else {
            $countCart = 0;
        }
        $ekspedisi = Ekspedisi::all();
        $kupons = Coupon::all();
        // return dd($cart);
        return view('customers.cart.cart', compact('cart', 'countCart', 'ekspedisi', 'kupons', 'userAddress', 'getUsersProvince', 'getUsersCity', 'city', 'province', 'allCities', 'allProvince'));
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
}
