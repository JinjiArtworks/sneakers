@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="card mt-6">
            <div class="card-body">
                <h2 class="font-bold text-lg p-4">Ajuan Pengembalian Pesanan</h2>
                <table class="table-auto w-full text-left text-sm">
                    <thead>
                        <tr class="">
                            <th class="p-4 ">ID </th>
                            <th class="p-4 ">Tanggal </th>
                            <th class="p-4 ">Metode Pembayaran</th>
                            <th class="p-4 ">Ekspedisi</th>
                            <th class="p-4 ">Ongkos Kirim</th>
                            <th class="p-4 ">Total</th>
                            <th class="p-4 ">Status</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $item)
                        @if ($item->status == 'Proses Pengembalian')
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
                                        <form action="{{ route('return.details', ['id' => $item->id]) }}">
                                            <button type="submit" class="mt-3 btn-shadow text-black">Lihat Detail </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @elseif ($item->status == 'Pesanan Dikirim Balik Kepada Penjual')
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
                                        <form action="{{ route('return.details', ['id' => $item->id]) }}">
                                            <button type="submit" class="mt-3 btn-shadow text-black">Lihat Detail </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach

                </table>
            </div>
        </div>


    </div>
@endsection
