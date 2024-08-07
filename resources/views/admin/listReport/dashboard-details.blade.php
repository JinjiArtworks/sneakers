@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Bukti Resi Order ID :# {{ $orderData->order->id }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth ligth-data">
                                            <th class="text-left">Resi Image</th>
                                            <th class="text-left">Resi Number</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                        @foreach ($validations_admin as $item)
                                            <tr>
                                                <td class="text-left">
                                                    <img src="{{ asset('img/list/' . $item->resi_images) }}"
                                                        class="rounded avatar-100 mr-3" alt="image">
                                                </td>
                                                <td class="text-left"># <b>{{ $item->resi_number }}</b></td>

                                                {{-- <td>
                                                    <form method="GET"
                                                        action="{{ route('products.delete', ['id' => $item->id]) }}">
                                                        <button class="badge bg-danger mr-2 mt-2" type="submit"
                                                            class="deleteProduk">
                                                            <i class="ri-delete-bin-line mr-0"></i>
                                                        </button>
                                                    </form>
                                                </td> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Detail Order # {{ $orderData->order->id }}</h4>
                            </div>
                            @if ($orderData->order->status == 'Pesanan Dikirim Kepada Admin')
                                <form method="POST"
                                    action="{{ route('dashboard.update-confirm-admin', ['id' => $orderData->order_id]) }}">
                                    @csrf
                                    <input type="hidden" name="sellerID" value="{{ $getSellerId }}">
                                    {{ method_field('put') }}
                                    <button type="button" class=" btn btn-md bg-primary" data-toggle="modal"
                                        data-target="#confirmModalAdmin" data-whatever="@mdo">Konfirmasi Pesanan</button>
                                    {{-- <button class="sendItemToCustomer btn btn-md  btn-success mr-2 mt-2" type="submit"">
                                        Konfirmasi Pesanan
                                    </button> --}}
                                </form>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="data-tables table mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth ligth-data">
                                            <th>Product</th>
                                            <th>Sellers Name</th>
                                            <th>Quantity</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                        @foreach ($orderdetails as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('img/list/' . $item->product->images) }}"
                                                            class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                        {{ $item->product->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $item->order->sellers->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->product->productsseller->size }}</td>
                                                <td>{{ $item->order->status }}</td>
                                                <td>@currency($item->product->productsseller->price)</td>
                                                <td>@currency($item->order->total - $item->order->shipping_cost)</td>

                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('dashboard.decline-order-admin', ['id' => $orderData->order_id]) }}">
                                                        @csrf
                                                        {{ method_field('put') }}
                                                        <button class="declineOrder btn btn-md  btn-warning mr-2 mt-2"
                                                            type="submit"">
                                                            X
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>

    <div class="modal fade" id="confirmModalAdmin" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('dashboard.update-list-order', ['id' => $orderData->order_id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="resi" class="col-form-label">Nomor Resi</label>
                            <input type="text" name="resiNumber" class="form-control" id="resi" required>
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
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sendItemToCustomer').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Send Item To Customer?',
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
            $('.declineOrder').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Decline this order ?',
                    icon: 'warning',
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
        });
    </script>
@endsection
