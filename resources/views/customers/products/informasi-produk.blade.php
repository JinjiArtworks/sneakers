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
                <a href="/products">
                    Belanja
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="bg-white py-4 rounded-b-xl my-10 rounded-xl">
        <div class="container mx-auto flex items-center flex-wrap  pb-12">
            <nav id="store" class="flex w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between px-2 py-3">
                    <a class=" tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                        Detail Produk Kami
                    </a>
                    @foreach ($product as $item)
                        <table class="table-auto border-collapse w-full text-left text-xs my-2">
                            <tr>
                                <th class="py-2 px-4 border-t border-l border-gray-300 ">
                                    <img src="{{ asset('images/' . $item->gambar) }}" alt="">
                                </th>
                                <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Nama Produk</th>
                                <th class="py-2 px-4 border border-gray-300 font-normal">
                                    <span class="flex justify-between">{{ $item->nama }}
                                        <a href="/detail-product/{{ $item->id }}"
                                            class="badge badge-secondary text-white text-xs ">Lihat Produk </a>
                                    </span>
                                </th>
                            </tr>

                            <tr>
                                <th class="py-2 px-4 border-l  border-gray-300 w-40 font-normal"></th>
                                <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Brand </th>
                                <th class="py-2 px-4 border border-gray-300 font-normal">{{ $item->brand }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-l border-gray-300 w-40 font-normal"></th>
                                <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Bahan</th>
                                <th class="py-2 px-4 border border-gray-300 font-normal">{{ $item->bahan }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-l border-gray-300 w-40 font-normal"></th>
                                <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Deksripsi</th>
                                <th class="py-2 px-4 border border-gray-300 font-normal leading-5">{{ $item->deskripsi }}
                                </th>
                            </tr>
                          
                            <tr>
                                <th class="py-2 px-4 border-l border-b border-gray-300 w-40 font-normal"></th>
                                <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Alergi</th>
                                @if ($item->alergi != null)
                                    <th class="py-2 px-4 border border-gray-300 font-normal leading-5">
                                        <b>{{ $item->alergi->nama }}</b>
                                        <ul>
                                            <li>
                                                - {{ $item->alergi->deskripsi }}
                                            </li>
                                            <li>
                                                - {{ $item->alergi->efek }}
                                            </li>
                                        </ul>
                                    </th>
                                @else
                                    <th class="py-2 px-4 border border-gray-300 font-normal leading-5">
                                        Tidak ada kandungan alergi.
                                    </th>
                                @endif
                            </tr>
                        </table>
                    @endforeach
                </div>
            </nav>
        </div>
    </section>
@endsection
