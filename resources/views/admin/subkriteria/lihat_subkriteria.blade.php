@extends('admin.admin_master')
@section('admin')
@php
    // Variable to track if any value exceeds 100
    $exceeds100 = false;

    foreach ($subkriteriaList as $subkriteria) {
        $bobot = $subkriteria->bobot_sub;
        if ($bobot > 100) {
            $exceeds100 = true;
            break; // Exit the loop if a value exceeds 100
        }
    }
@endphp
<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Tabel Sub-Kriteria</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Sub-Kriteria</h4>
                    <p class="card-title-desc">Ini adalah tabel data yang berisikan Sub Kriteria-Kriteria. 
                        Sub Kriteria nerupakan cabang atau ekstensi dari Kriteria untuk lebih mendefinisikan kriteria-kriteria.
                    </p>
                    @if ($exceeds100)
                    <p class="text-danger"><strong>Perhatikan Nilai Bobot Sub-Kriteria. Setiap Nilai Bobot Sub-Kriteria Tidak Boleh Melebihi 100!!</strong></p>
                    @endif
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 140px;">Nomor Sub-Kriteria</th>
                            <th>Nama Sub-Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th style="width: 140px;">Bobot Sub-Kriteria</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                        </thead>


                        <tbody>
                            @php($i = 1)
                            @foreach($subkriteriaList as $subKriteria)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $subKriteria->nama_subkriteria }}</td>
                                    <td>{{ $subKriteria->kriteria->nama_kriteria }}</td>
                                    <td>{{ $subKriteria->bobot_sub }}</td>
                                    <td>
                                        <a href="{{ route('ubah.subkriteria', $subKriteria->id) }}" class="btn btn-info sm" title="Edit Data"><i
                                            class="fas fa-edit"></i> </a>
                                        <a href="{{ route('hapus.subkriteria', $subKriteria->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i
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