@extends('admin.admin_master')
@section('admin')

@php 


$kriteria = App\Models\Kriteria::latest()->get();
$subkriteria = App\Models\SubKriteria::latest()->get();
$alternatif = App\Models\Alternatif::latest()->get();
$user = App\Models\User::latest()->get();

$skoralternatif = App\Models\SkorAlternatif::orderByDesc('skor')->get();


@endphp

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Halaman Utama</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item active">Halaman Utama</li>
        </ol>
    </div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Pengguna</p>
                <h4 class="mb-2">{{ $user->count() }}</h4>
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-primary rounded-3">
                    <i class="dripicons-user-group font-size-24"></i>  
                </span>
            </div>
        </div>                                            
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
<div class="col-xl-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-truncate font-size-14 mb-2">Total Alternatif</p>
                    <h4 class="mb-2">{{ $alternatif->count() }}</h4>
                </div>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-primary rounded-3">
                        <i class="fas fa-user-tie font-size-24"></i>  
                    </span>
                </div>
            </div>                                            
        </div><!-- end cardbody -->
    </div><!-- end card -->
    </div><!-- end col -->
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Kriteria</p>
                <h4 class="mb-2">{{ $kriteria->count() }}</h4>
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-success rounded-3">
                    <i class="fas fa-list-alt font-size-24"></i>  
                </span>
            </div>
        </div>                                              
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Sub-Kriteria</p>
                <h4 class="mb-2">{{ $subkriteria->count() }}</h4>
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-primary rounded-3">
                    <i class="fas fa-code-branch font-size-24"></i>  
                </span>
            </div>
        </div>                                              
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->

</div><!-- end row -->

<div class="row">
    <div class="col-xl-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Petunjuk dan Panduan Menggunakan Aplikasi Web Sistem Pendukung Keputusan</h4>
            <p>Penjelasan mengenai aplikasi dibagi menjadi 4 Tab sesuai dengan 4 Bagian Utama aplikasi</p>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">Alternatif</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Kriteria</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block">Sub-Kriteria</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-block">Nilai Alternatif</span>    
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <p class="mb-0" style="text-align: justify;">
                        Alternatif diisi dengan mempersiapkan nama alternatif, dalam kasus ini nama alternatif adalah
                        nama karyawan yang mendaftarkan diri pada perusahaan. Menambahkan Alternatif dapat melalui 
                        menu 'Pengaturan Alternatif' pada bagian Tambah Alternatif. Untuk melihat daftar Alternatif yang telah ditambahkan
                        dapat dilihat pada menu bagian 'Lihat Alternatif'. Di halaman lihat alternatif, alternatif dapat dihapus dan diubah.
                        Apabila Alternatif berhasil ditambahkan, notifikasi berhasil akan muncul
                    </p>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel">
                    <p class="mb-0" style="text-align: justify;">
                        Kriteria dipilih berdasarkan hal yang relevan dan penting untuk penerimaan karyawan.
                        Kriteria dapat ditambahkan di menu 'Pengaturan Kriteria' pada halaman 'Tambah Kriteria'.
                        Setiap penambahan kriteria, kriteria diberi bobot untuk menggambarkan tingkat kepentingannya.
                        Skala bobot untuk menggambarkan kepentingan sebesar 1-100. Daftar Kriteria dapat dilihat
                        dari halaman 'Lihat Kriteria', di halaman tersebut Kriteria dapat dihapus dan diubah sesuai
                        kebutuhan pengguna. <br><br>
                        Selain itu, pada setiap Kriteria perlu ditentukan apa atribut kriteria tersebut. Atribut Kriteria
                        terbagi menjadi dua yaitu 'Cost' dan 'Benefit'. Atribut Cost diberikan untuk kriteria yang memiliki
                        Sub-Kriteria atau Variabel yang memiliki sifat semakin rendah bobot atau nilai sub-kriteria tersebut, semakin dianggap baik kriteria tersebut.<br>
                        Contoh : Kriteria 'Harapan Gaji', dengan Sub-Kriteria <= RP. 1.000.000 (bobot = 1) dan Rp. 1.000.000 - 2.000.000 (bobot = 2). Untuk Kriteria ini
                        Sub-Kriteria dengan bobot yang lebih rendah yaitu <= Rp. 1.000.000 dianggap lebih baik. <br><br>
                        Selanjutnya adalah Atribut Benefit, atribut benefit singkatnya adalah kebalikan dari Atribut Cost dengan sifat semakin tinggi bobot Sub-Kriteria,
                        semakin dianggap baik kriteria tersebut.<br> 
                        Contoh : Kriteria 'Pengalaman' dengan Sub-Kriteria <= 1 Tahun (bobot = 1), 1-2 Tahun (bobot = 2). Untuk Kriteria ini, Sub-Kriteria dengan bobot
                        lebih tinggi yaitu 1-2 Tahun dianggap lebih baik.
                        
                    </p>
                </div>
                <div class="tab-pane" id="messages" role="tabpanel">
                    <p class="mb-0" style="text-align: justify;">
                        Sub-Kriteria atau biasa disebut variabel dari Kriteria dapat ditambahkan pada menu 'Pengaturan Sub-Kriteria'.
                        Pastikan sebelum mengisi Sub-Kriteria, Kriteria sudah di-isi terlebih dahulu.
                        Sub-Kriteria ditambahkan dengan mengisi 'Nama Sub-Kriteria', memilih Sub-Kriteria berasal dari Kriteria yang mana
                        dan menentukan bobot Sub-Kriteria. Bobot Sub-Kriteria di-isi dengan memasukkan Nilai dalam Skala 1-5, angka 1 
                        sebagai nilai terendah dan angka 5 sebagai nilai tertinggi. <br><br>
                        Daftar Sub-Kriteria yang telah ditambahkan dapat dilihat pada halaman 'Lihat Sub-Kriteria', pada halaman tersebut
                        Sub-Kriteria dapat dihapus dan diubah sesuai kebutuhan.
                    </p>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <p class="mb-0" style="text-align: justify;">
                        Pada menu 'Nilai Alternatif' memiliki fungsi untuk menghitung skor setiap Alternatif yang telah 
                        ditambahkan berdasarkan Kriteria dan Sub-Kriteria yang telah ditentukan. Untuk menghitung skor setiap Alternatif,
                        Alternatif yang perlu dipertimbangkan untuk perhitungan harus ditambahkan terlebih dahulu. Alternatif-alternatif
                        tersebut dapat ditambahkan pada halaman 'Tambah Nilai Alternatif'. Di halaman ini pengguna dapat memilih Alternatif
                        yang telah ditambahkan dan Sub-Kriteria dari setiap Kriteria yang telah ditentukan untuk Alternatif tersebut.<br><br>
                        Setelah berhasil menambahkan Alternatif untuk diperhitungkan skornya, daftar Alternatif tersebut dapat dilihat pada
                        halaman 'Lihat Nilai Alternatif'. Pada halaman ini setiap Nilai Alternatif yang ditambahkan hanya dapat dihapus dan
                        tidak dapat diubah. Pada halaman ini terdapat tombol dengan tulisan 'Hitung Skor Alternatif', tombol ini akan menghitung
                        Skor setiap Alternatif yang telah tersimpan pada sistem sesuai dengan daftar Alternatif yang ditampilkan pada tabel
                        di halaman 'Lihat Nilai Alternatif'. <br><br>
                        <strong>Catatan :</strong> <br>
                        - Sistem tidak akan menerima alternatif yang ditambahkan lebih dari sekali. 
                        Untuk mengubah alternatif yang telah ditambahkan, alternatif tersebut harus dihapus terlebih dahulu
                        di halaman 'Lihat Nilai Alternatif'.<br>
                        - Pastikan untuk menentukan Kriteria dan Sub-Kriteria terlebih dahulu sebelum menambahkan Nilai Alternatif.
                        Apabila ada Kriteria yang ditambahkan, Alternatif yang telah ditambahkan pada halaman 'Nilai Alternatif' harus
                        direset terlebih dahulu dengan menghapus setiap alternatif di halaman 'Lihat Nilai Alternatif' dan menambahkan
                        kembali alternatif.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<!-- end row -->

<div class="row">
<div class="col-xl-12">
<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Skor Tiap Calon Pegawai</h4>

        <div class="table-responsive">
            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                <thead class="table-light">
                    <tr>
                        <th style="max-width: 10%;">Ranking</th>
                        <th style="max-width: 20%;">Nama</th>
                        <th>Deskripsi Karyawan</th>
                        <th>Skor</th>
                    </tr>
                </thead><!-- end thead -->
                <tbody>
                    @php($i = 1)
                    @foreach($skoralternatif as $item)
                    <tr>
                        <td><h6 class="mb-0">{{ $i++ }}</h6></td>
                        <td>{{ $alternatif->where('id' , $item->alternatif_id)->value('nama_alternatif')}}</td>
                        <td>{!! $alternatif->where('id' , $item->alternatif_id)->value('deskripsi_alternatif')!!}</td>
                        <td>
                            <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>{{ $item->skor }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody><!-- end tbody -->
            </table> <!-- end table -->
        </div>
    </div><!-- end card -->
</div><!-- end card -->
</div>
<!-- end col -->

</div>
<!-- end row -->
</div>

</div>

@endsection