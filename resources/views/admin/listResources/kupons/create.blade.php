@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Tambah Kupon</p>
            </div>
            <div class="p-6">
                <form method="POST" action="/store-kupons" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="kodeKupon" class="block mb-2 text-sm font-medium text-gray-900 ">Kode Kupon</label>
                        <input type="number" name="kodeKupon" min="1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Kode Kupon Produk" required>
                    </div>
                    <div class="mb-4">
                        <label for="potonganKupon" class="block mb-2 text-sm font-medium text-gray-900 ">Potongan
                        </label>
                        <input type="number" name="potonganKupon" min="1"
                            oninput="this.value = Math.abs(this.value)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Potongan Kupon" required>
                    </div>
                    <div class="mb-4">
                        <label for="kuponBerlaku" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Berlaku
                        </label>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3""
                            name="kuponBerlaku" required type="date" placeholder="Tanggal Berlaku" aria-label="date"
                            max="<?= date('Y-m-d') ?>" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-4">
                        <label for="kuponBerakhir" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Berakhir
                        </label>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3""
                            name="kuponBerakhir" required type="date" placeholder="Tanggal Berakhir" aria-label="date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <button type="submit"
                        class="add-coupon text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 ">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.add-coupon').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Tambah Kupon?',
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
