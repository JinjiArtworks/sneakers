@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="grid grid-cols-4 gap-6 xl:grid-cols-1">
            <div class="report-card">
                <div class="card">
                    <div class="card-body flex flex-col">
                        <div class="flex flex-row justify-between items-center">
                            <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>

                        </div>
                        <div class="mt-8">
                            <h1 class="h5 num-4">{{ $totalSalesOrders }}</h1>
                            <p>Total Pesanan</p>
                        </div>
                    </div>
                </div>
                <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
            </div>
            <div class="report-card">
                <div class="card">
                    <div class="card-body flex flex-col">
                        <div class="flex flex-row justify-between items-center">
                            <div class="h6 text-red-700 fad fa-store"></div>
                        </div>
                        <div class="mt-8">
                            <h1 class="h5 num-4">@currency($pendapatanBersih)</h1>
                            <p>Total Pendapatan Bersih</p>
                        </div>
                    </div>
                </div>
                <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
            </div>
            <div class="report-card">
                <div class="card">
                    <div class="card-body flex flex-col">
                        <div class="flex flex-row justify-between items-center">
                            <div class="h6 text-yellow-600 fad fa-sitemap"></div>
                        </div>
                        <div class="mt-8">
                            <h1 class="h5 num-4">{{ $getTotalProducts }}</h1>
                            <p>Total Produk</p>
                        </div>
                    </div>
                </div>
                <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
            </div>
            <div class="report-card">
                <div class="card">
                    <div class="card-body flex flex-col">
                        <div class="flex flex-row justify-between items-center">
                            <div class="h6 text-green-700 fad fa-users"></div>
                        </div>
                        <div class="mt-8">
                            <h1 class="h5 num-4">{{ $totalCompleteOrders }}</h1>
                            <p>Transaksi Selesai</p>
                        </div>
                    </div>
                </div>
                <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
            </div>
        </div>
        <div class="card mt-6">
            <div class="card-body">
                <h2 class="font-bold text-lg p-4">Pesanan Terbaru</h2>
                <table class="table-auto w-full text-left text-sm">
                    <thead>
                        <tr class="">
                            <th class="p-4 ">ID Pesanan</th>
                            <th class="p-4 ">Tanggal Pesanan</th>
                            <th class="p-4 ">Metode Pembayaran</th>
                            <th class="p-4 ">Ekspedisi</th>
                            <th class="p-4 ">Ongkos Kirim</th>
                            <th class="p-4 ">Total</th>
                            <th class="p-4 ">Status</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $item)
                        @if ($item->status != 'Selesai')
                            <tbody>
                                <tr>
                                    <td class="p-4">{{ $item->id }}</td>

                                    <td class="p-4 font-bold">{{ $item->tanggal_orders }}</td>

                                    @if ($item->jenis_pembayaran == 'bank_transfer')
                                        <td class="p-4">Transfer Bank</td>
                                    @else
                                        <td class="p-4">{{ $item->jenis_pembayaran }}</td>
                                    @endif
                                    {{-- {{ dd($item->ekspedisi)}} --}}
                                    <td class="p-4">JNE - {{ $item->ekspedisi }}</td>
                                    <td class="p-4">@currency($item->ongkos_kirim)</td>
                                    <td class="p-4">@currency($item->total)</td>
                                    <td class="p-4"><span
                                            class="badge btn-indigo btn-sm p-2 text-white text-xs">{{ $item->status }}</span>
                                    </td>
                                    <td class="p-4">
                                        <form action="{{ route('dashboard.details', ['id' => $item->id]) }}">
                                            <button type="submit" class="mt-3 btn-shadow text-black">Details </button>
                                        </form>
                                    </td>

                                </tr>
                            </tbody>
                        @endif
                    @endforeach

                </table>
            </div>
        </div>

        {{-- <div class="card mt-6">
            <div class="card-body">
                <div class="flex flex-row justify-between items-center">
                    <h1 class="font-extrabold text-lg">best sellers</h1>
                    <a href="#" class="btn-gray text-sm">view all</a>
                </div>
                <table class="table-auto w-full mt-5 text-right">
                    <thead>
                        <tr>
                            <td class="py-4 font-extrabold text-sm text-left">product</td>
                            <td class="py-4 font-extrabold text-sm">price</td>
                            <td class="py-4 font-extrabold text-sm">sold</td>
                            <td class="py-4 font-extrabold text-sm">profit</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                                <div class="w-8 h-8 overflow-hidden mr-3">
                                    <img src="{{ asset('images/admins/sneakers.svg') }}" class="object-cover">
                                </div>
                                Sneakers and Tennis
                            </td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                            <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                        </tr>
                        <tr class="">
                            <td class="py-4 text-sm text-gray-600 flex flex-row items-center">
                                <div class="w-8 h-8 overflow-hidden mr-3">
                                    <img src="{{ asset('images/admins/socks.svg') }}" class="object-cover">
                                </div>
                                Crazy Socks & Graphic Socks for Men
                            </td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                            <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                        </tr>
                        <tr class="">
                            <td class="py-4 text-sm text-gray-600 flex flex-row items-center">
                                <div class="w-8 h-8 overflow-hidden mr-3">
                                    <img src="{{ asset('images/admins/soccer.svg') }}" class="object-cover">
                                </div>
                                Adidas Soccer Ball
                            </td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                            <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                        </tr>
                        <tr class="">
                            <td class="py-4 text-sm text-gray-600 flex flex-row items-center">
                                <div class="w-8 h-8 overflow-hidden mr-3">
                                    <img src="{{ asset('images/admins/food.svg') }}" class="object-cover">
                                </div>
                                Best Chocolate Chip Cookies
                            </td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                            <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                            <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
        <div class="card mt-6">
            <div class="card-body">
                <h2 class="font-bold text-lg p-4">Daftar Pesanan Selesai</h2>
                <table class="table-auto w-full text-left text-sm">
                    <thead>
                        <tr class="">
                            <th class="p-4 ">ID Pesanan</th>
                            <th class="p-4 ">Tanggal Pesanan</th>
                            <th class="p-4 ">Metode Pembayaran</th>
                            <th class="p-4 ">Ekspedisi</th>
                            <th class="p-4 ">Ongkos Kirim</th>
                            <th class="p-4 ">Total</th>
                            <th class="p-4 ">Status</th>
                        </tr>
                    </thead>
                    @foreach ($ordersComplete as $item)
                        <tbody>
                            <tr>
                                <td class="p-4">{{ $item->id }}</td>
                                <td class="p-4 font-bold">{{ $item->tanggal_orders }}</td>
                                @if ($item->jenis_pembayaran == 'bank_transfer')
                                    <td class="p-4">Transfer Bank</td>
                                @else
                                    <td class="p-4">{{ $item->jenis_pembayaran }}</td>
                                @endif
                                {{-- {{ dd($item->ekspedisi)}} --}}
                                <td class="p-4">JNE - {{ $item->ekspedisi }}</td>
                                <td class="p-4">@currency($item->ongkos_kirim)</td>
                                <td class="p-4">@currency($item->total)</td>
                                <td class="p-4"><span
                                        class="badge btn-indigo btn-sm p-2 text-white text-xs">{{ $item->status }}</span>
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('dashboard.details', ['id' => $item->id]) }}">
                                        <button type="submit" class="mt-3 btn-shadow text-black">Details </button>
                                    </form>
                                </td>

                            </tr>
                        </tbody>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
{{-- <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="grid grid-cols-2 lg:grid-cols-1 gap-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="font-extrabold text-lg">best sellers</h1>
                        <a href="#" class="btn-gray text-sm">view all</a>
                    </div>
                    <table class="table-auto w-full mt-5 text-right">
                        <thead>
                            <tr>
                                <td class="py-4 font-extrabold text-sm text-left">product</td>
                                <td class="py-4 font-extrabold text-sm">price</td>
                                <td class="py-4 font-extrabold text-sm">sold</td>
                                <td class="py-4 font-extrabold text-sm">profit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                                    <div class="w-8 h-8 overflow-hidden mr-3">
                                        <img src="{{ asset('images/admins/sneakers.svg') }}" class="object-cover">
                                    </div>
                                    Sneakers and Tennis
                                </td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                                <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                            </tr>
                            <tr class="">
                                <td class="py-4 text-sm text-gray-600 flex flex-row items-center">
                                    <div class="w-8 h-8 overflow-hidden mr-3">
                                        <img src="{{ asset('images/admins/socks.svg') }}" class="object-cover">
                                    </div>
                                    Crazy Socks & Graphic Socks for Men
                                </td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                                <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                            </tr>
                            <tr class="">
                                <td class="py-4 text-sm text-gray-600 flex flex-row items-center">
                                    <div class="w-8 h-8 overflow-hidden mr-3">
                                        <img src="{{ asset('images/admins/soccer.svg') }}" class="object-cover">
                                    </div>
                                    Adidas Soccer Ball
                                </td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                                <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                            </tr>
                            <tr class="">
                                <td class="py-4 text-sm text-gray-600 flex flex-row items-center">
                                    <div class="w-8 h-8 overflow-hidden mr-3">
                                        <img src="{{ asset('images/admins/food.svg') }}" class="object-cover">
                                    </div>
                                    Best Chocolate Chip Cookies
                                </td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-2"></span></td>
                                <td class="py-4 text-xs text-gray-600"><span class="num-3"></span></td>
                                <td class="py-4 text-xs text-gray-600">$ <span class="num-4"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>
    </div> --}}
