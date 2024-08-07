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
        // dd($productSeller->models);
        $models = Models::all();
        // dd($models->productSeller->id);
        // return dd($products);
        return view('customers.home', compact('products', 'productSeller', 'models'));
    }
}
