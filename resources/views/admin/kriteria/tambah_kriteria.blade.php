@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
        <h4 class="card-title">Halaman Tambah Kriteria</h4> <br>
        <form method="POST" action="{{ route('simpan.kriteria') }}">
            @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="nama_kriteria" name="nama_kriteria">
                    @error('nama_kriteria')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Atribut Kriteria</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="atribut_kriteria" id="atribut_kriteria">
                        <option selected="">Pilih Salah Satu</option>
                        <option value="Cost">Cost</option>
                        <option value="Benefit">Benefit</option>
                        </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Bobot Kriteria</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" id="bobot" name="bobot" placeholder="Masukkan Nilai Bobot dalam Skala 1-100">
                    @error('bobot')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- end row -->
            <div class="col-sm-10">
                <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Kriteria">
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