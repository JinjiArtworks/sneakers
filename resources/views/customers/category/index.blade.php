@extends('layouts.customers')
@section('breadcrumbs')
    <div class="text-sm breadcrumbs mt-4">
        <ul>
            <li>
                <a href="/">
                    Home
                </a>
            </li>
            <li>
                <a href="/category">
                    Kategori
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="bg-white py-4 rounded-b-xl my-6 rounded-xl">
        <div class="container mx-auto flex items-center flex-wrap  pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container flex flex-wrap px-2 py-3">
                    <div class="pt-2 relative text-gray-600">
                        <a class=" tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                            href="#">
                            Kategori Produk Kami
                        </a>
                    </div>
                </div>
            </nav>
            @foreach ($categories as $item)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="/detail-category/{{ $item->id }}">
                        <img class="hover:grow hover:shadow-lg w-60 h-60" src="{{ asset('images/' . $item->gambar) }}">
                        <div class="pt-3 flex items-center justify-center">
                            <p class="">{{ $item->nama }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="flex my-4 justify-center">
            <div class="join">
                <button class="join-item btn btn-active">1</button>
                <button class="join-item btn ">2</button>
                <button class="join-item btn">3</button>
                <button class="join-item btn">4</button>
            </div>
        </div>
    </section>
@endsection
