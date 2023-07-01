@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
        <h4 class="card-title">Halaman Ubah Kriteria</h4> <br>
        <form method="POST" action="{{ route('update.kriteria') }}">
            @csrf

            <input type="hidden" name="id" value="{{ $kriteria->id }}">
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="nama_kriteria" name="nama_kriteria" 
                    value="{{ $kriteria->nama_kriteria }}">
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
                        <option value="Cost" {{ ($kriteria->atribut_kriteria == "Cost") ? 'selected' : '' }}>Cost</option>
                        <option value="Benefit" {{ ($kriteria->atribut_kriteria == "Benefit") ? 'selected' : '' }}>Benefit</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Bobot Kriteria</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" id="bobot" name="bobot"
                    value="{{ $kriteria->bobot }}">
                    @error('bobot')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- end row -->
            <div class="col-sm-10">
                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Kriteria">
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