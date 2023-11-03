@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Detail Order # {{ $orderData->order->id }}</h4>
                                <h4 class="card-title">Disini admin bisa melihat bukti resi dan foto dari penjual yang
                                    mengirim.</h4>
                            </div>
                            @if ($orderData->order->status == 'Pesanan Dikirim Kepada Admin')
                                <form method="POST"
                                    action="{{ route('dashboard.update-confirm-admin', ['id' => $orderData->order_id]) }}">
                                    @csrf
                                    {{ method_field('put') }}
                                    <button class="sendItemToCustomer badge bg-success mr-2 mt-2" type="submit"">
                                        Konfirmasi Pesanan dan KIRIM KEPADA PEMBELI
                                    </button>
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
                                            <th>Action</th>
                                            <th></th>
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
                                                <td>{{ $item->order->users->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->product->productsseller->size }}</td>
                                                <td>{{ $item->order->status }}</td>
                                                <td>@currency($item->product->productsseller->price)</td>

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
                </div>
            </div>
            <!-- Page end  -->
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
        });
    </script>
@endsection