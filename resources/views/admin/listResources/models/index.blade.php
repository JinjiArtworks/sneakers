@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div class="mt-4">
                            <h4 class="mb-3">Shoes Model</h4>
                            <p class="mb-0"></p>
                        </div>
                        <a href="/create-models" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add
                            New Model</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-tables table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>Image</th>
                                    <th>models Name</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($models as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('img/list/' . $item->thumbnail) }}"
                                                class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <form action="{{ route('models.edit-models', ['id' => $item->id]) }}">
                                                <button class="badge bg-success mr-2 mt-2" type="submit"">
                                                    <i class="ri-pencil-line mr-0"></i>
                                                </button>
                                            </form>
                                        <td>
                                            <form method="GET"
                                                action="{{ route('models.delete-models', ['id' => $item->id]) }}">
                                                <button class="deleteProduk badge bg-warning mr-2 mt-2" type="submit">
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
