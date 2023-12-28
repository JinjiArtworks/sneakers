<?php

namespace App\Http\Controllers\Customers;

use App\Models\Product;
use App\Models\ProductSeller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModelController extends Controller
{

    public function detail($id)
    {
        $getProducts = ProductSeller::whereModelsId($id)->first();
        $userId = Auth::user()->id;
        $getImages = Product::pluck('images', 'name')->toArray();
        // $allProducts = DB::table('products')->pluck('name')->toArray();
        $productsSeller = ProductSeller::select('*')
            ->where('models_id', '=', $id)
            ->where('user_id', '!=', $userId)
            ->get();
        $getProductId = ProductSeller::first();
        // $recommendations = [];
        // foreach ($allProducts as $product) {
        //     $coefficient = $this->calculateJaccardCoefficient($getProducts->product_id, $product);
        //     $recommendations[$product] = $coefficient;
        // }
        $getImagesByName = [];
        foreach ($getImages as $productImages) {
            $coefficient = $this->calculateJaccardCoefficient($getProducts->product_id, $productImages);
            $getImagesByName[$productImages] = $coefficient;
        }
        // foreach ($getImages as $productImages) {
        //     foreach ($allProducts as $product) {
        //         $coefficient = $this->calculateJaccardCoefficient($getProducts->product_id, $productImages, $product);
        //         $getImagesByName[$productImages . ' ' . $product] = $coefficient;
        //     }
        // }
        // Sort products based on Jaccard coefficient in descending order
        // arsort($recommendations);
        arsort($getImagesByName);
        $topRecommendationsImage = array_slice($getImagesByName, 0, 4, true);
        $images = array_keys($topRecommendationsImage);
        // dd(round($topRecommendationsImage));
        // $roundedArray = array_map('ceil', $topRecommendationsImage);
        // dd($images);
        return view('customers.models.details', compact('productsSeller', 'userId', 'images', 'getProductId', 'getProducts'));
    }
    private function calculateJaccardCoefficient($product1, $product2)
    {
        $arr1 = str_split(strtolower($product1));
        $arr2 = str_split(strtolower($product2));

        $intersection = array_intersect($arr1, $arr2);
        $union = array_merge($arr1, $arr2);
        // $arr1 = explode(' ', $product1);
        // $arr2 = explode(' ', $product2);

        // $intersection = array_intersect($arr1, $arr2);
        // $union = array_unique(array_merge($arr1, $arr2));
        return count($intersection) / count($union);
    }
    // public function detailProductIsSell($id, $idProduct, $userID)
    // {
    //     // FUNCTION INI UNTUK MENAMPILKAN DETAIL PRODUK YG SUDAH ADA PENJUALNYA 
    //     $userSaldo = Auth::user()->saldo;
    //     $productsSeller = ProductSeller::select('*')
    //         ->where('id', '=', $id)
    //         ->where('product_id', '=', $idProduct)
    //         ->where('user_id', '=', $userID)
    //         ->first();
    //     $products = Product::whereId($idProduct)->first();

    //     // dd($userProduct);
    //     // Get all product names from the database
    //     // Calculate Jaccard coefficient for each product

    //     // dd($getRecommendProcut);
    //     return view('customers.products.detail-products-seller', compact('names', 'productsSeller', 'userSaldo', 'products', 'countReviews', 'getReviews'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
