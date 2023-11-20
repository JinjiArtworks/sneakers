<?php

namespace App\Http\Controllers\Customers;

use App\Models\Categories;
use App\Models\Faq;
use App\Models\Models;
use App\Models\Product;
use App\Models\ProductSeller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $productSeller = ProductSeller::all();
        // $productsIdSeller = '';
        // foreach ($productSeller as $p) {
        //     $productsIdSeller = $p->product_id;
        // }
        // // dd($productsIdSeller);
        // $getAllProducts = Product::whereId($productsIdSeller)->get();
        // dd($getAllProducts);
        // return dd($products[0]['gambar']);
        $models = Models::all();
        // return dd($products);
        return view('customers.home', compact('products', 'productSeller', 'models'));
    }
}
