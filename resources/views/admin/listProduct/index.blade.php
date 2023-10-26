@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div class="mt-4">
                            <h4 class="mb-3">Product List</h4>
                            <p class="mb-0"></p>
                        </div>
                        <a href="/create-products" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add
                            Product</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-tables table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Brand Name</th>
                                    <th>Terjual</th>
                                    <th>Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('img/list/' . $item->images) }}"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                <div> {{ $item->name }} </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->categories->name }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->sold }}</td>
                                        {{-- @if ($item->users_id != null)
                                            <td>{{ $item->users->name }}</td>
                                        @endif --}}
                                        <td>
                                            <form action="{{ route('products.edit', ['id' => $item->id]) }}">
                                                <button class="badge bg-success mr-2 mt-2" type="submit"">
                                                    <i class="ri-pencil-line mr-0"></i>
                                                </button>
                                            </form>
                                        <td>
                                            <form method="GET"
                                                action="{{ route('products.delete', ['id' => $item->id]) }}">
                                                <button class="badge bg-warning mr-2 mt-2" type="submit"
                                                    class="deleteProduk">
                                                    <i class="ri-delete-bin-line mr-0"></i>
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
            <!-- Page end  -->
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup text-left">
                            <div class="media align-items-top justify-content-between">
                                <h3 class="mb-3">Product</h3>
                                <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                            </div>
                            <div class="content edit-notes">
                                <div class="card card-transparent card-block card-stretch event-note mb-0">
                                    <div class="card-body px-0 bukmark">
                                        <div
                                            class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                            <div class="quill-tool">
                                            </div>
                                        </div>
                                        <div id="quill-toolbar1">
                                            <p>Virtual Digital Marketing Course every week on Monday, Wednesday and
                                                Saturday.Virtual Digital Marketing Course every week on Monday</p>
                                        </div>
                                    </div>
                                    <div class="card-footer border-0">
                                        <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                            <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                            <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.deleteProduk').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Produk?',
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
    </script>
@endsection
