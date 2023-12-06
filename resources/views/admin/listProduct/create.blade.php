@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Product</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/store-products" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" name="products"
                                                placeholder="Enter Products Name" data-errors="Please Enter Name." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Models </label>
                                            <select name="models" class="selectpicker testMOdel form-control"
                                                data-style="py-0">
                                                @foreach ($models as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- penjual hanya nambah harga dan size --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <br>
                                            <img src="{{ asset('img/list/icon-sepatu.jpeg') }}" id="imgPreview"
                                                width="150px" height="150px" class="mb-3">
                                            <br>
                                            <input type="file" id="image" class=" image-file" name="images" required
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" id="" class="form-control" placeholder="Description" cols="30" rows="5"
                                                required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input type="text" name="brand" class="form-control"
                                                placeholder="Enter Brand" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="confirm btn btn-primary mr-2">Add Product</button>
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
        $('.testMOdel').change(function() {
            console.log('asd');
        });
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
