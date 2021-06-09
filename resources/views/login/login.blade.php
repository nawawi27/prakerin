<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Monitoring - Masuk</title>
    <meta content="Masuk Monitoring" name="Login" />
    <meta content="Roni Surya" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="">

    <!-- App css -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- Alertify -->
    <link href="{{asset('admin/plugins/alertify/css/alertify.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <h3 class="text-center m-0">
                    {{-- <a href="/" class="text-dark mt-2">Larjo</a> --}}
                    <a href="/" class="logo logo-admin"><img src="{{ asset('admin/images/image.png') }}" width="125" height="125" alt="logo"></a>
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Selamat Datang !</h4>
                    <p class="text-muted text-center">Masukkan Nama Pengguna Dan Kata Sandi Untuk Melanjutkan.</p>
                     <form class="form-horizontal m-t-30" action="{{ route('post.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" class="form-control" name="username" id="username" required="" placeholder="Masukkan Nama Pengguna">
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" name="password" required="" class="form-control" id="password" placeholder="Masukkan Kata Sandi">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline" name="ingatSaya">
                                    <label class="custom-control-label" for="customControlInline">Ingat Saya!</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="m-t-40 text-center">
            <p>© {{ date('Y') }} Dikembangkan Oleh Muhamad Nawawi.</p>
        </div>

    </div>


    <!-- jQuery  -->
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/modernizr.min.js')}}"></script>
    <script src="{{asset('admin/js/waves.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('admin/js/jquery.scrollTo.min.js')}}"></script>
    <!-- Alertify js -->
    <script src="{{asset('admin/plugins/alertify/js/alertify.js')}}"></script>
    <script src="{{asset('admin/pages/alertify-init.js')}}"></script>

    <!-- Parsley js -->
    <script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>

    <!-- App js -->
    <script src="{{asset('admin/js/app.js')}}"></script>

    <!-- Alert -->
    <script>
    @if(Session::has('error'))
        alertify.error("Nama Pengguna Atau Kata Sandi Salah!");
    @endif
    </script>

</body>
</html>