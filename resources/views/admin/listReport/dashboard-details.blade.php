@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="card mt-6">
            <div class="card-body">
                <div class="flex justify-between font-bold text-lg mx-4 my-2">
                    <h2>Detail Pesanan - status : {{ $orders->status }}</h2>
                    @if ($orders->status == 'Sedang Diproses')
                        <form method="POST" action="{{ route('dashboard.update', ['id' => $orders->id]) }}">
                            @csrf
                            {{ method_field('put') }}
                            <button type="submit" class="send-order btn-shadow text-xs text-black">Kirim Pesanan</button>
                        </form>
                    @endif
                </div>
                <div class="mb-4 ml-4">
                    <p class="text-black mb-2">Penerima : {{ $orders->nama }}</p>
                    <p class="text-black mb-2">Alamat : {{ $orders->alamat }}</p>
                    <p class="text-black">Nomor Handphone : {{ $orders->no_handphone }}</p>
                </div>
                <hr class="m-4">
                <table class="table-auto w-full text-left text-sm">
                    <thead>
                        <tr class="">
                            {{-- <th class="p-4 ">Nama Pelanggan</th>
                                <th class="p-4 ">Nomor Handphone </th>
                                <th class="p-4 ">Alamat </th> --}}

                            <th class="p-4 ">Gambar</th>
                            <th class="p-4 ">Nama produk</th>
                            <th class="p-4 ">Harga</th>
                            <th class="p-4 ">Quantity</th>
                            <th class="p-4 ">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderdetails as $item)
                            <tr>
                                {{-- <td class="p-4">{{ $orderdetails->order->nama }}</td>
                                <td class="p-4">{{ $orderdetails->order->no_handphone }}</td>
                                <td class="p-4">{{ $orderdetails->order->alamat }}</td> --}}
                                <td class="p-4">
                                    <img src="{{ asset('images/' . $item->product->gambar) }}" class="w-20 h-20 "
                                        alt="">
                                </td>
                                <td class="p-4">{{ $item->product->nama }}</td>
                                <td class="p-4">@currency($item->product->harga)</td>
                                <td class="p-4">{{ $item->qty }}</td>
                                <td class="p-4">@currency($item->harga * $item->qty)</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div id="returns-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="faq-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only p-4">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Alasan Pengembalian</h3>
                    <form method="POST" action="{{ route('return.confirm', ['id' => $orders->id]) }}"
                        enctype="multipart/form-data" id="submit_form">
                        <input type="hidden" name="json" id="json_callback">
                        @csrf
                        <label for="productStock" class="block text-sm font-medium text-gray-900 ">Alasan :
                        </label>
                        <textarea type="text" name="pertanyaan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Pertanyaan" required> </textarea>

                    </form>
                    <div class="flex justify-center">
                        <button type="submit" id="pay-button"
                            class="pay w-full text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm  px-5 py-2 ">Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.send-order').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Kirim Pesanan?',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
