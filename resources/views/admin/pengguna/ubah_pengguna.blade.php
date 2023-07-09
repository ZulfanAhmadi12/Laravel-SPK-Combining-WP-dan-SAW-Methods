@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
        <h4 class="card-title">Halaman Ubah Pengguna</h4> <br>
        <form method="POST" action="{{ route('update.pengguna') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $pengguna->id }}">
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pengguna</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="name" name="name" 
                    value="{{ $pengguna->name }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="username" name="username"
                    value="{{ $pengguna->username }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="email" name="email"
                    value="{{ $pengguna->email }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Peran Pengguna</label>
                <div class="col-sm-10">
                    <select id="role" name="role" class="form-select" aria-label="Select one of them">
                        <option selected="">Select one of the categories</option>
                        <option value="0" {{ $pengguna->role == "user" ? 'selected' : '' }}>User</option>
                        <option value="1" {{ $pengguna->role == "admin" ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Gambar Profil</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="image" name="profile_image">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($pengguna->profile_image)) 
                        ? url('upload/admin_image/'.$pengguna->profile_image)
                        : url('upload/no_image.jpg') }}" 
                    alt="Card image cap">
            </div>
            </div>
            <!-- end row -->
            <div class="col-sm-10">
                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Pengguna">
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