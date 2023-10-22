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
                <a href="/riwayat-pesanan">
                    Riwayat Pesanan
                </a>
            </li>
            <li>
                <a href="/detail-pesanan/{{ $getIdOrder }}">
                    Detail Riwayat Pesanan
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="py-8 rounded-b-xl mb-10 ">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <div class="bg-white p-3 shadow-sm border-2 border-secondary rounded-xl w-full">
                <div class="w-full px-6 rounded-l-xl">
                    <div class="flex items-center justify-between space-x-2 font-semibold text-gray-900 leading-8 ">
                        <span class="tracking-wide text-xl underline my-3"> Review </span>
                    </div>
                    <div class="flex mt-5 mb-5">
                        <h3 class="font-semibold text-xs uppercase w-2/5">Product Details</h3>
                        <h3 class="font-semibold text-xs uppercase w-1/5 text-center">Quantity</h3>
                        <h3 class="font-semibold text-xs uppercase w-1/5 text-center">Price</h3>
                        <h3 class="font-semibold text-xs uppercase w-1/5 text-center">Total</h3>
                    </div>
                    {{-- @foreach ($orderDetails as $item) --}}
                    {{-- {{ dd($item->product->gambar) }} --}}
                    <div class="flex items-center hover:bg-pink-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-28">
                                <img class="h-24" src="{{ asset('images/' . $orderDetails->product->gambar) }}"
                                    alt="">
                            </div>
                            <div class="flex flex-col justify-center ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $orderDetails->product->nama }}</span>
                                <span class="font-normal text-xs">Ukuran : {{ $orderDetails->product->ukuran }}</span>
                            </div>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">x{{ $orderDetails->qty }}</span>
                        @if ($orderDetails->diskon == null)
                            <span class="text-center w-1/5 font-semibold text-sm">@currency($orderDetails->harga)</span>
                        @else
                            <span class="text-center w-1/5 font-semibold text-sm">@currency($orderDetails->harga - $orderDetails->diskon)</span>
                        @endif
                        <span class="text-center w-1/5 font-semibold text-sm">@currency($orderDetails->harga * $orderDetails->qty)</span>
                    </div>
                    @if ($orderDetails->product->rating == null)
                        @if ($orderDetails->order->status == 'Selesai')
                            <form method="POST"
                                action="{{ route('history-order.review', ['id' => $orderDetails->product_id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <hr class="mt-4 mb-4">
                                <h3 class="font-bold text-lg underline">Berikan Review </h3>
                                <label class="label">
                                    <span class="label-text ">Rating Anda : </span>
                                </label>
                                <div class="rating">
                                    <input type="radio" name="rating" value="1"
                                        class="mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating" value="2"
                                        class="mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating" value="3"
                                        class="mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating" value="4"
                                        class="mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating" value="5"
                                        class="mask mask-star-2 bg-orange-400" checked />
                                </div>
                                <label class="label">
                                    <span class="label-text">Komentar</span>
                                </label>
                                <textarea name="comment" class="block p-2 text-gray-600 w-full text-sm" placeholder="Masukkan Komentar"></textarea>
                                <button
                                    class="confirm mt-4 btn-checkout rounded-xl font-semibold p-3 text-xs text-white uppercase "
                                    style="background:#ef9fbc" type="submit">Konfirmasi
                                </button>
                            </form>
                        @elseif ($orderDetails->order->status == 'Sedang Diproses')
                            <div class="mt-4">
                                <p>Selesaikan Pesanan Untuk Memberikan Review</p>
                            </div>
                        @elseif ($orderDetails->order->status == 'Pesanan Dikirim')
                            <div class="mt-4">
                                <p>Selesaikan Pesanan Untuk Memberikan Review</p>
                            </div>
                        @endif
                    @else
                        <div class="mt-4">
                            <p>Anda sudah memberikan review terhadap produk ini.</p>
                        </div>
                    @endif

                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Kirim Review?',
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
