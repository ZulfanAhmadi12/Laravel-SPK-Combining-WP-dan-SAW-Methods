@extends('admin.admin_master')
@section('admin')
@php 
    // Variable to track if any value exceeds 100
    $exceeds100 = false;

    foreach ($kriteria as $kriteriaItem) {
        $bobot = $kriteriaItem->bobot;
        if ($bobot > 100) {
            $exceeds100 = true;
            break; // Exit the loop if a value exceeds 100
        }
    }    
    // $kriteria = App\Models\Alternatif::with('kriterias')->latest()->get();
    // $alternatif = App\Models\Kriteria::with('alternatifs')->latest()->get();

    // The code assign to the $subKriterias will take the subKriterias() eloquent function result from $kriteria. then you can directly access the value of subKriterias like this dd($subKriterias[0]->nama_subkriteria);
    // With this i don't have to query two times by calling the instance using just latest()->get() then calling the relation using eloquent function in models. 
    // i can just call it once from database all of it, then manipulate it using PHP function pluck() and flatten()
    // $subKriterias = $kriteria->pluck('kriterias')->flatten();

@endphp

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Tabel Kriteria</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Kriteria</h4>
                    <br><p class="card-title-desc">Ini adalah tabel data yang berisikan Kriteria-Kriteria. 
                        Kriteria tersebut merupakan kondisi atau penentu yang dapat mempengaruhi hasil keputusan
                        dari Sistem Pendukung Keputusan.
                    </p>
                    @if ($exceeds100)
                    <p class="text-danger"><strong>Perhatikan Nilai Bobot Kriteria. Setiap Nilai Bobot Kriteria Tidak Boleh Melebihi 100!!</strong></p>
                    @endif
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 140px;">Nomor Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th style="width: 140px;">Atribut Kriteria</th>
                            <th style="width: 140px;">Bobot Kriteria</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                        </thead>


                        <tbody>
                            @php($i = 1)
                            @foreach($kriteria as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->nama_kriteria	 }}</td>
                            <td>{{ $item->atribut_kriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <a href="{{ route('ubah.kriteria', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i
                                    class="fas fa-edit"></i> </a>
                                <a href="{{ route('hapus.kriteria', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i
                                    class="fas fa-trash-alt"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    
</div> <!-- container-fluid -->
</div>

@endsection