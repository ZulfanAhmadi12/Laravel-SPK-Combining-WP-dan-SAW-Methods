@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
        <h4 class="card-title">Halaman Tambah Alternatif</h4> <br>
        <form method="POST" action="{{ route('simpan.alternatif') }}">
            @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Alternatif</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="nama_alternatif" name="nama_alternatif">
                    @error('nama_alternatif')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Deskripsi Alternatif</label>
                <div class="col-sm-10">
                    <textarea id="elm1" name="deskripsi_alternatif">
                    </textarea>
                </div>
            </div>
            <!-- end row -->
            <div class="col-sm-10">
                <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Alternatif">
            </div>
        </form>
        </div>
    </div>
</div> <!-- end col -->
</div>





</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection