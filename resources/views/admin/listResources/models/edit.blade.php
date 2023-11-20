@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit models</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('models.update-models', ['id' => $models->id]) }} "enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="{{ asset('img/list/'.$models->thumbnail) }}" id="imgPreview"
                                                width="150px" height="150px" class="mb-3">
                                            <input type="file" id="image" class="form-control image-file"
                                                name="catImages" accept="image/*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Kategori</label>
                                            <input type="text" name="catName" class="form-control"
                                                placeholder="Enter models Name" value="{{ $models->name }}" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="confirm btn btn-primary mr-2">Confirm</button>
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
    <script>
        $('.confirm-edit').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Perubahan?',
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
    <script type="text/javascript">
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
