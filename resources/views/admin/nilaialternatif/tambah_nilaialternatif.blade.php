@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@php 

$kriteria = App\Models\Kriteria::with('subKriterias')->get();
$alternatif = App\Models\Alternatif::latest()->get();
    // The code assign to the $subKriterias will take the subKriterias() eloquent function result from $kriteria. then you can directly access the value of subKriterias like this dd($subKriterias[0]->nama_subkriteria);
    // With this i don't have to query two times by calling the instance using just latest()->get() then calling the relation using eloquent function in models. 
    // i can just call it once from database all of it, then manipulate it using PHP function pluck() and flatten(), but becuase this method doesn't start at $kriteriaItem->subKriterias as $subKriteriaItem
    // I can't access the sub criteria value belong to individual criteria. i can only access every sub-criteria using this method because the start of querying doesn't at the individual criteria
    // but a whole collection instance of criteria.
    // $subKriterias = $kriteria->pluck('subKriterias')->flatten();

@endphp
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
        <h4 class="card-title">Halaman Tambah Nilai Alternatif</h4> <br>
        <form method="POST" action="{{ route('simpan.alternatifkriteria') }}">
            @csrf

            @if(!$alternatif->isEmpty())
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Pilih Alternatif</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="alternatif_id" id="alternatif_id">
                            <option value="">Pilih Salah Satu</option>
                            @foreach($alternatif as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_alternatif }}</option>
                            @endforeach
                        </select>
                        @error('alternatif_id')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                </div>
            </div>
            @else
            <p class="card-title text-danger">Alternatif Masih Kosong, Silahkan Tambah Alternatif Terlebih Dahulu</p>
            @endif

            @if(!$kriteria->isEmpty())
            @foreach ($kriteria as $kriteriaItem)
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Kriteria : {{ $kriteriaItem->nama_kriteria }}</label>
                <input type="hidden" name="kriteria_id[]" value="{{ $kriteriaItem->id }}">
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="subkriteria_id[]" id="subkriteria_id">
                            <option value="">Pilih Salah Satu</option>
                            @foreach($kriteriaItem->subKriterias as $subKriteriaItem)
                            <option value="{{ $subKriteriaItem->id }}">{{ $subKriteriaItem->nama_subkriteria }}</option>
                            @endforeach
                        </select>
                        @error('subkriteria_id')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                </div>
            </div>
            @endforeach

            @endif

            <!-- end row -->
            <div class="col-sm-10">
                <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Nilai Alternatif">
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