@extends('layouts.admin')
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
                                action="{{ route('products.update', ['id' => $products->id]) }} "enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Name *</label>
                                            <input type="text" class="form-control" name="products"
                                                value="{{ $products->name }}" placeholder="Enter Products Name"
                                                data-errors="Please Enter Name." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Models *</label>
                                            <select name="models" class="selectpicker form-control" data-style="py-0">
                                                @foreach ($models as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $products->models_id == $item->id ? 'selected' : null }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- penjual hanya nambah harga dan size --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="{{ asset('img/list/' . $products->images) }}" id="imgPreview"
                                                width="150px" height="150px" class="mb-3">
                                            <br>
                                            <input type="file" id="image" class=" image-file" name="images" required
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <input type="text" name="stock" class="form-control"
                                                placeholder="Enter Stock" value="{{ $products->stock }}" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input type="text" name="brand" class="form-control"
                                                placeholder="Enter Brand" value="{{ $products->brand }}" required>
                                            <div class="help-block with-errors"></div>
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
    <script type="text/javascript">
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
            }
        }
        $('.confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Produk?',
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
