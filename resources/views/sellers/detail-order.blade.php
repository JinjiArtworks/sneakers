@extends('layouts.sellers')
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
                                <form method="POST"
                                    action="{{ route('seller.update-list-order', ['id' => $getOrderDetailsStatus->order_id]) }}">
                                    @csrf
                                    {{ method_field('put') }}
                                    <button class="sendItemToAdmin badge bg-primary mr-2 mt-2" type="submit">
                                        Send Item to ADMIN
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Images</th>
                                            <th>Name Product</th>
                                            {{-- <th>Buyer Name</th> --}}
                                            <th>Address</th>
                                            {{-- <th>Size</th> --}}
                                            {{-- <th>Quantity</th> --}}
                                            <th>Shipping Cost</th>
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
                                                {{-- <td>{{ $item->order->name }}</td> --}}
                                                <td>{{ $item->order->address }}</td>
                                                {{-- <td>{{ $item->product->productsseller->size }}</td> --}}
                                                {{-- <td>{{ $item->quantity }}</td> --}}
                                                <td>@currency($item->order->shipping_cost)</td>
                                                <td>@currency($item->quantity * $item->price)</td>
                                                <td>@currency($item->order->total)</td>
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
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
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
        });
    </script>
@endsection
