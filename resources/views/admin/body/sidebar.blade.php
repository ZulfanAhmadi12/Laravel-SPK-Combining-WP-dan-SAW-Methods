<div class="vertical-menu">

    @php 
    $id = Auth::user()->id;
    $user = App\Models\User::find($id);
    @endphp

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty($user->profile_image)) 
                    ? url('upload/admin_image/'.$user->profile_image)
                    : url('upload/no_image.jpg') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ $user->name }}</h4>
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu" >
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Halaman Utama</span>
                    </a>
                </li>
    
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-database-settings"></i>
                        <span>Pengaturan Kriteria</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('lihat.kriteria') }}">Lihat Kriteria</a></li>
                        <li><a href="{{ route('tambah.kriteria') }}">Tambah Kriteria</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-arrow-decision"></i>
                        <span>Pengaturan Alternatif</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('lihat.alternatif') }}">Lihat Alternatif</a></li>
                        <li><a href="{{ route('tambah.alternatif') }}">Tambah Alternatif</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri ri-file-list-2-fill"></i>
                        <span style="font-size: 12px;">Pengaturan Sub-Kriteria</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('lihat.subkriteria') }}">Lihat Sub-Kriteria</a></li>
                        <li><a href="{{ route('tambah.subkriteria') }}">Tambah Sub-Kriteria</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-clipboard-list"></i>
                        <span style="font-size: 11px;">Pengaturan Nilai Alternatif</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('lihat.alternatifkriteria') }}">Lihat Nilai Alternatif</a></li>
                        <li><a href="{{ route('tambah.alternatifkriteria') }}">Tambah Nilai Alternatif</a></li>
                        <li><a href="{{ route('lihat.skoralternatif') }}">Lihat Skor Alternatif</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-cog"></i>
                        <span>Pengaturan Pengguna</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('lihat.pengguna') }}">Lihat Pengguna</a></li>
                        <li><a href="{{ route('register.admin') }}">Tambah Pengguna</a></li>
                    </ul>
                </li>     
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
