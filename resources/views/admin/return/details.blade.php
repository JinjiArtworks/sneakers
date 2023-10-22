@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card mt-6">
            <div class="card-body">
                <h2 class="font-bold text-lg p-4">Pesanan yang diajukan</h2>
                <table class="table-auto w-full text-left text-sm">
                    <thead>
                        <tr class="">
                            <th class="p-4 ">Gambar</th>
                            <th class="p-4 ">Nama produk</th>
                            <th class="p-4 ">kategori</th>
                            <th class="p-4 ">harga</th>
                            <th class="p-4 ">ukuran</th>
                            <th class="p-4 ">stok</th>
                            <th class="p-4 ">terjual</th>
                            <th class="p-4 ">berat</th>
                        </tr>
                    </thead>
                    @foreach ($orderdetails as $item)
                        <tbody>
                            <tr>
                                <td class="p-4">
                                    <img src="{{ asset('images/' . $item->product->gambar) }}" class="w-20 h-20 "
                                        alt="">
                                </td>
                                <td class="p-4">{{ $item->product->nama }}</td>
                                <td class="p-4">{{ $item->product->categories->nama }}</td>
                                <td class="p-4">@currency($item->product->harga)</td>
                                <td class="p-4">{{ $item->product->ukuran }}</td>
                                <td class="p-4">{{ $item->product->stok }}</td>
                                <td class="p-4">{{ $item->product->terjual }}</td>
                                <td class="p-4">{{ $item->product->berat }}g</td>

                            </tr>
                        </tbody>
                    @endforeach
                </table>

            </div>

        </div>
        <div class="card mt-6">
            <div class="card-body">
                <h2 class="font-bold text-lg p-4">Alasan Pengembalian Pesanan </h2>
                <span>
                    <small class="ml-4"> Status : {{ $getOrderDetails->order->status }}</small>
                </span>
                <form method="POST" action="{{ route('return.update', ['id' => $getOrderDetails->order_id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <table class="table-auto w-full text-left text-sm m-4">
                        <tbody>
                            <tr>
                                <th class="p-4 border border-gray-300 w-40 font-medium">Alasan Pengembalian
                                    Pesanan </th>
                                <th class="p-4 border border-gray-300 ">{{ $returnOrder->alasan }}</th>
                            </tr>
                            <tr>
                                <th class="p-4 border border-gray-300 w-40 font-medium">Bukti Pengembalian
                                </th>
                                <th class="p-4 border border-gray-300 ">
                                    <img src="{{ asset('images/' . $returnOrder->bukti) }}" style="width: 120px">
                                </th>
                            </tr>
                            @if ($getOrderDetails->order->status == 'Proses Pengembalian')
                                <tr>
                                    <th class="p-4 border border-gray-300 w-40 font-medium">Bukti Pengembalian
                                    </th>
                                    <th class="p-4 border border-gray-300 ">

                                        <select name="status" id="status"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3">>
                                            <option value="Ajuan Pengembalian Diterima">Terima Pengembalian</option>
                                            <option value="Ajuan Pengembalian Ditolak">Tolak Pengembalian</option>
                                        </select>
                                    </th>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    @if ($getOrderDetails->order->status == 'Proses Pengembalian')
                        <div class="flex justify-end mt-4 mb-4">
                            <button class=" btn-sm text-sm mt-3 btn-shadow text-black">
                                Konfirmasi
                            </button>
                        </div>
                    @endif
                </form>
                @if ($getOrderDetails->order->status == 'Pesanan Dikirim Balik Kepada Penjual')
                    <form method="POST" action="{{ route('return.confirm', ['id' => $getOrderDetails->order_id]) }}"
                        enctype="multipart/form-data" id="submit_form">
                        <input type="hidden" name="json" id="json_callback">
                        @csrf
                    </form>
                    <div class="flex justify-end mt-4 mb-4">
                        <button id="pay-button" class="pay btn-sm text-sm mt-3 btn-shadow text-black">
                            Konfirmasi Terima Pesanan
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- End Recent Sales -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.pay', function() {
                // alert('asdas');
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{ $snap_token }}', {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            console.log(result);
                            send_response_to_form(result);
                        },
                        onPending: function(result) {
                            alert(
                                'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
                            );
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal.');

                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('Batalkan pembayaran ? ');
                        }
                    })
                });

                function send_response_to_form(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    $('#submit_form').submit();
                }
            });

        });
    </script>
@endsection
