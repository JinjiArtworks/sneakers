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
                                    <th>Models</th>
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
                                        <td>{{ $item->models->name }}</td>
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
                                                <button class=" deleteProduk badge bg-warning mr-2 mt-2" type="submit">
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
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".content").hide();
            $(".show_hide").on("click", function() {
                var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
                $(".show_hide").text(txt);
                $(this).next('.content').slideToggle(200);
            });
        });
        $('.deleteProduk').click(function(event) {
            console.log('test');
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
