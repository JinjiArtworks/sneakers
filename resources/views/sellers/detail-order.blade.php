@extends('layouts.sellers')
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
            <span class="bg-primary "></span>
        </a>
        <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="card shadow-none m-0">
                <div class="card-body p-0 ">
                    <div class="cust-title p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Notifications</h5>
                            <a class="badge badge-primary badge-card" href="#">3</a>
                        </div>
                    </div>
                    <div class="px-3 pt-0 pb-0 sub-card">
                        <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card py-3 border-bottom">
                                <div class="">
                                    <img class="avatar-50 rounded-small" src="../assets/images/user/01.jpg" alt="01">
                                </div>
                                <div class="media-body ml-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-0">Emma Watson</h6>
                                        <small class="text-dark"><b>12 : 47
                                                pm</b></small>
                                    </div>
                                    <small class="mb-0">Lorem ipsum dolor sit
                                        amet</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card py-3 border-bottom">
                                <div class="">
                                    <img class="avatar-50 rounded-small" src="../assets/images/user/02.jpg" alt="02">
                                </div>
                                <div class="media-body ml-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-0">Ashlynn Franci</h6>
                                        <small class="text-dark"><b>11 : 30
                                                pm</b></small>
                                    </div>
                                    <small class="mb-0">Lorem ipsum dolor sit
                                        amet</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card py-3">
                                <div class="">
                                    <img class="avatar-50 rounded-small" src="../assets/images/user/03.jpg" alt="03">
                                </div>
                                <div class="media-body ml-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-0">Kianna Carder</h6>
                                        <small class="text-dark"><b>11 : 21
                                                pm</b></small>
                                    </div>
                                    <small class="mb-0">Lorem ipsum dolor sit
                                        amet</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#" role="button">
                        View All
                    </a>
                </div>
            </div>
        </div>
    </li>
@endsection
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">List Order</h4>
                            </div>
                            @if ($getOrderDetailsStatus->order->status == 'Proses Validasi Admin')
                                <button type="button" class=" btn btn-md bg-primary" data-toggle="modal"
                                    data-target="#confirmModal" data-whatever="@mdo">Send Product</button>
                                {{-- <button class="sendItemToAdmin btn bg-primary mr-2 mt-2" type="submit">
                                        Send Item to ADMIN
                                    </button> --}}
                            @else
                                <a href="/seller-dashboard/{{ $userId }}" class="btn btn-sm btn-primary"><i
                                        class="fa-solid fa-arrow-left"></i> Back</a>
                            @endif

                        </div>
                        <div class="description ml-3 mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    Penerima : {{ $getOrderDetailsStatus->order->name }} <span class="float-right mr-3">Date
                                        Order : <b> {{ $getOrderDetailsStatus->order->date }}</b></span>
                                </div>
                                <div class="col-lg-12">
                                    Nomor Handphone : {{ $getOrderDetailsStatus->order->phone }}
                                </div>
                                <div class="col-lg-12">
                                    Alamat : {{ $getOrderDetailsStatus->order->address }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Images</th>
                                            <th>Name Product</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            {{-- <th>Shipping Cost</th> --}}
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetails as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('img/list/' . $item->product->images) }}"
                                                        style="width: 100px;" alt="">
                                                </td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->product->productsseller->size }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                {{-- <td>@currency($item->order->shipping_cost)</td> --}}
                                                <td>@currency($item->price)</td>
                                                <td>@currency($item->quantity * $item->price)</td>
                                                <td>@currency($item->quantity * $item->price + $item->order->shipping_cost)</td>
                                                {{-- <td>@currency($item->order->total)</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Send Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('seller.update-list-order', ['id' => $getOrderDetailsStatus->order_id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="resi" class="col-form-label">Nomor Resi</label>
                            <input type="text" name="resiNumber" class="form-control" id="resi" required>
                        </div>
                        <div class="form-group">
                            <label for="resi" class="col-form-label">Bukti Foto Produk</label>
                            <br>
                            <img src="{{ asset('img/list/icon-sepatu.jpeg') }}" id="imgPreview" width="150px"
                                height="150px" class="mb-3">
                            <input type="file" id="image" name="resiImage" accept="image/*" required>
                        </div>
                        <button type="submit" class="sendItemToAdmin btn btn-primary">Confirm</button>
                    </form>
                </div>
                {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> --}}
            </div>
        </div>
    </div>
    <!-- Footer Section End -->
@endsection
@section('script')
    <script type="text/javascript">
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
            }
        }
        $('.sendItemToAdmin').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Send Item To Admin?',
                icon: 'info',
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
