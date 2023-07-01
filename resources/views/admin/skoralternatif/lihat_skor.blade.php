@extends('admin.admin_master')
@section('admin')

@php 

$alternatif = App\Models\Alternatif::latest()->get();

@endphp

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Tabel Skor Alternatif </h4>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Skor Alternatif</h4>
                    <p class="card-title-desc">Ini adalah tabel data yang berisikan Skor Setiap Alternatif. 
                        Skor setiap alternatif pada tabel ini dihitung menggunakan metode SAW (Simple Additive Weight) dan dikembangkan dengan metode WP (Weighted Product).
                    </p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="max-width: 10%;">Nomor Alternatif</th>
                            <th style="max-width: 20%;">Nama Alternatif</th>
                            <th>Deskripsi Alternatif</th>
                            <th style="max-width: 10%;">Skor</th>
                            <th style="max-width: 10%;">Aksi</th>
                        </tr>
                        </thead>


                        <tbody>
                            @php($i = 1)
                            @foreach($skoralternatif as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $alternatif->where('id' , $item->alternatif_id)->value('nama_alternatif')}}</td>
                            <td>{{ $alternatif->where('id' , $item->alternatif_id)->value('deskripsi_alternatif')}}</td>
                            <td>{{ $item->skor }}</td>
                            <td>
                                <a href="{{ route('hapus.skoralternatif', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i
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