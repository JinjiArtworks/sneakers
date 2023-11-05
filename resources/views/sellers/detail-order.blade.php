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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Images</th>
                                            <th>Name Product</th>
                                            <th>Buyer Name</th>
                                            <th>Address</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            {{-- <th>Shipping Cost</th> --}}
                                            <th>Price</th>
                                            <th>Sub Total</th>
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
                                                <td>{{ $item->order->name }}</td>
                                                <td>{{ $item->order->address }}</td>
                                                <td>{{ $item->product->productsseller->size }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                {{-- <td>@currency($item->order->shipping_cost)</td> --}}
                                                <td>@currency($item->price)</td>
                                                <td>@currency($item->quantity * $item->price)</td>
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
