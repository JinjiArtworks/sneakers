@extends('layouts.sellers')
@section('messages')
    <li class="nav-item nav-icon nav-item-icon dropdown">
        <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-bell">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="bg-warning "> {{ count($notifDecline) }}</span>
        </a>
        <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
            <div class="card shadow-none m-0">
                <div class="card-body p-0 ">
                    <div class="cust-title p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Decline Order</h5>
                            <a class="badge badge-warning badge-card" href="#"> {{ count($notifDecline) }}</a>
                        </div>
                    </div>
                    <div class="px-3 pt-0 pb-0 sub-card">
                        @foreach ($notifDecline as $key => $item)
                            <a href="#" class="iq-sub-card">
                                <div class="media align-items-center cust-card py-3 border-bottom">
                                    <div class="">
                                        <img src="{{ asset('img/list/' . $item->orderdetail->product->images) }}"
                                            style="width: 50px;" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ $item->users->name }}</h6>
                                            <small class="text-dark"><b>{{ $item->date }}</b></small>
                                        </div>
                                        <small class="mb-0">{{ $item->orderdetail->product->name }}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </li>
@endsection
@section('notif')
    <li class="nav-item nav-icon nav-item-icon dropdown">
        <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-bell">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="bg-primary "> {{ count($notifOrder) }}</span>
        </a>
        <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="card shadow-none m-0">
                <div class="card-body p-0 ">
                    <div class="cust-title p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Notifications</h5>
                            <a class="badge badge-primary badge-card" href="#">{{ count($notifOrder) }}</a>
                        </div>
                    </div>
                    <div class="px-3 pt-0 pb-0 sub-card">
                        @foreach ($notifOrder as $key => $item)
                            <a href="#" class="iq-sub-card">
                                <div class="media align-items-center cust-card py-3 border-bottom">
                                    <div class="">
                                        <img src="{{ asset('img/list/' . $item->orderdetail->product->images) }}"
                                            style="width: 50px;" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ $item->users->name }}</h6>
                                            <small class="text-dark"><b>{{ $item->date }}</b></small>
                                        </div>
                                        <small class="mb-0">{{ $item->orderdetail->product->name }}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </li>
@endsection
@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Ubah Product</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('seller.update-product', ['id' => $products->id]) }} "enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Size</label>
                                            <select name="size" class="form-control">
                                                <option value="{{ $products->size }}"> {{ $products->size }}</option>
                                                <option value="7 (EUR 37-38)">7 (EUR 37-38)</option>
                                                <option value="7.5 (EUR 38)">7.5 (EUR 38)</option>
                                                <option value="8 (EUR 38-39)">8 (EUR 38-39)</option>
                                                <option value="8.5 (EUR 39)">8.5 (EUR 39)</option>
                                                <option value="9 (EUR 39-40)">9 (EUR 39-40)</option>
                                                <option value="9.5 (EUR 40)">9.5 (EUR 40)</option>
                                                <option value="10 (EUR 40-41)">10 (EUR 40-41)</option>
                                                <option value="10.5 (EUR 41)">10.5 (EUR 41)</option>
                                                <option value="11 (EUR 41-42)">11 (EUR 41-42)</option>
                                                <option value="11.5 (EUR 42)">11.5 (EUR 42)</option>
                                                <option value="12 (EUR 42-43)">12 (EUR 42-43)</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Price Product:</label>
                                            <input type="text" class="form-control" id="tanpa-rupiah" name="price"
                                                placeholder="Price Product" value="{{ $products->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Stock Product:</label>
                                            <input type="number" min="1" value="{{ $products->stock }}"
                                                oninput="this.value = Math.abs(this.value)" class="form-control"
                                                name ="stock" placeholder="Stock Product" required>
                                        </div>
                                    </div>
                                </div>

                               
                                <button type="submit" class="btn btn-primary mr-2">Confirm</button>
                                {{-- <button type="reset" class="btn btn-danger">Reset</button> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        var tanpa_rupiah = document.getElementById('tanpa-rupiah');
        tanpa_rupiah.addEventListener('keyup', function(e) {
            tanpa_rupiah.value = formatRupiah(this.value);
        });
        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        // $('.confirm').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     Swal.fire({
        //         title: 'Add Product?',
        //         icon: 'success',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit();
        //         }
        //     });
        // });
    </script>
@endsection
