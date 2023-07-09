@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tabel Info Pengguna</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Pengguna</h4>
                    <br>
                    <p class="card-title-desc">Ini adalah tabel data pengguna yang berisikan informasi setiap pengguna yang terdaftar pada sistem aplikasi ini.
                    </p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 140px;">Nomor</th>
                            <th>Nama Pengguna</th>
                            <th style="width: 140px;">Username</th>
                            <th style="width: 140px;">Peran</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                        </thead>


                        <tbody>
                            @php($i = 1)
                            @foreach($pengguna as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->name	 }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ ($item->role == 'user') ? "User" : "Admin" }}</td>
                            <td>
                                <a href="{{ route('ubah.pengguna', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i
                                    class="fas fa-edit"></i> </a>
                                <a href="{{ route('hapus.pengguna', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i
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