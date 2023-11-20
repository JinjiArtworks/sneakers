<?php

namespace App\Http\Controllers\Customers;

use App\Models\Categories;
use App\Models\Models;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ModelController extends Controller
{
    public function index()
    {
        $models = Models::all();
        // return dd($products);
        return view('customers.category.index', compact('models'));
    }

    public function detail($id)
    {
        $products_model = Product::whereModelsId($id)->get();
        $getDetailsModel = Product::whereModelsId($id)->first();
        // return dd($categories);
        return view('customers.category.details', compact('products_model','getDetailsModel'));
    }
    public function create()
    {
        //
    }

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
