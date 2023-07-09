<!doctype html>
<html lang="en">

<head>
    
    <meta charset="utf-8" />
    <title>Register | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="index.html" class="auth-logo">
                                <img src="{{ asset('backend/assets/images/lambangUMP.png') }}" height="90" class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('backend/assets/images/lambangUMP.png') }}" height="90" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b>Tambah Pengguna</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal mt-3" method="POST" action="{{ route('register.admin.account') }}">
                            @csrf
                            
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="name" name="name" type="text" required="" placeholder="Name">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="username" name="username" type="text" required="" placeholder="Username">
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="email" name="email" type="email" required="" placeholder="Email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="password" name="password" type="password" required="" placeholder="Password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required="" placeholder="Password Confirmation">
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3 text-center">
                                    <a href="{{ route('dashboard') }}" class="btn btn-light w-50 waves-effect waves-light">Kembali</a>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->
    

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/') }}assets/libs/node-waves/waves.min.js"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

</body>
</html>
