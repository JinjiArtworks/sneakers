@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1  rounded-xl">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Data Sumber Daya</p>
            </div>
            <div class="flex">
                <div class="m-4 bg-white border border-gray-200 rounded-lg shadow w-48">
                    <a href="/add-kupons">
                        <img class=" w-full" src="{{ asset('images/no-profile.png') }}" alt="product image" />
                    </a>
                    <div class="flex justify-center mb-4 ">
                        <h5 class="font-semibold text-gray-900 dark:text-white">Kupon</h5>
                    </div>
                </div>
                <div class="m-4 bg-white border border-gray-200 rounded-lg shadow w-48">
                    <a href="/add-kategori">
                        <img class=" w-full" src="{{ asset('images/no-profile.png') }}" alt="product image" />
                    </a>
                    <div class="flex justify-center mb-4 ">
                        <h5 class="font-semibold text-gray-900 dark:text-white">Kategori Produk</h5>
                    </div>
                </div>
                <div class="m-4 bg-white border border-gray-200 rounded-lg shadow w-48">
                    <a href="/add-alergi">
                        <img class=" w-full" src="{{ asset('images/no-profile.png') }}" alt="product image" />
                    </a>
                    <div class="flex justify-center mb-4 ">
                        <h5 class="font-semibold text-gray-900 dark:text-white">Data Alergi Produk</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
