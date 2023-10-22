<?php

namespace App\Http\Controllers\Customers;

use App\Models\Categories;
use App\Models\Faq;
use App\Models\Product;
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
        $products = Product::paginate(4)->all();
        // return dd($products[0]['gambar']);
        $categories = Categories::all();
        // return dd($products);
        return view('customers.home', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        $faq = Faq::all();
        return view('customers.faq.index', compact('faq'));
    }
}
