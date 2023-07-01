@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@php 

$kriteria = App\Models\Kriteria::latest()->get();

@endphp

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
        <h4 class="card-title">Halaman Ubah Sub-Kriteria</h4> <br>
        <form method="POST" action="{{ route('update.subkriteria') }}">
            @csrf

            <input type="hidden" name="id" value="{{ $subkriteria->id }}">
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Sub-Kriteria</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="nama_subkriteria" name="nama_subkriteria" 
                    value="{{ $subkriteria->nama_subkriteria }}">
                    @error('nama_subkriteria')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            @if(!$kriteria->isEmpty())
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Pilih Kriteria</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kriteria_id" id="kriteria_id">
                            <option value="">Pilih Salah Satu</option>
                            @foreach($kriteria as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kriteria }}</option>
                            @endforeach
                        </select>
                        @error('kriteria_id')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                </div>
            </div>
            @endif
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Bobot Sub-Kriteria</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" id="bobot_sub" name="bobot_sub"
                    value="{{ $subkriteria->bobot_sub }}">
                    @error('bobot_sub')
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