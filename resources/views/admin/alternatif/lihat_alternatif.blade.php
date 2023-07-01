@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Tabel Alternatif </h4>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Alternatif</h4>
                    <p class="card-title-desc">Ini adalah tabel data yang berisikan Alternatif-Alternatif. 
                        Alternatif mengacu pada pilihan atau opsi yang dapat dipertimbangkan dalam pengambilan keputusan. 
                        Alternatif ini mewakili berbagai kemungkinan tindakan atau solusi yang dapat diambil untuk mencapai tujuan yang diinginkan..
                    </p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="max-width: 10%;">Nomor Alternatif</th>
                            <th style="max-width: 20%;">Nama Alternatif</th>
                            <th>Deskripsi Alternatif</th>
                            <th style="max-width: 15%;">Aksi</th>
                        </tr>
                        </thead>


                        <tbody>
                            @php($i = 1)
                            @foreach($alternatif as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->nama_alternatif	 }}</td>
                            <td>{!! $item->deskripsi_alternatif !!}</td>
                            <td>
                                <a href="{{ route('ubah.alternatif', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i
                                    class="fas fa-edit"></i> </a>
                                <a href="{{ route('hapus.alternatif', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i
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