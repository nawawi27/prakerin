<!DOCTYPE html>
<html>
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Monitoring - Layar Dikunci!</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="">

        <!-- App css -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('admin/plugins/alertify/css/alertify.css')}}" rel="stylesheet" type="text/css">
    </head>


    <body>
        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="{{ url()->previous() }}" class="text-dark mt-2">Logo</a>
                    <!-- <a href="/" class="logo logo-admin"><img src="" height="30" alt="logo"></a> -->
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Layar Dikunci!</h4>
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                            $time = date('H:i:s');
                        @endphp

                        <p class="text-muted text-center">Hallo {{ $jquin->nama_lengkap }}, Masukkan Kata Sandi Untuk Membuka Kembali Layar!</p>

                        <form class="form-horizontal m-t-30" method="POST" action="{{ route('buka.layar') }}">
                            @csrf
                            <div class="user-thumb text-center m-b-30">
                                <img src="{{asset('storage/'.$jquin->path)}}" class="rounded-circle img-thumbnail" alt="avatar">
                                <h6>{{ $jquin->nama_lengkap }}</h6>
                            </div>

                            <div class="form-group">
                                <label for="kata_sandi">Kata Sandi</label>
                                <input type="password" class="form-control" id="kata_sandi" placeholder="Masukkan Kata Sandi" name="password">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Buka</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p>© {{ date('Y') }} Dikembangkan Oleh Roni Surya.</p>
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

        <!-- App js -->
        <script src="{{asset('admin/js/app.js')}}"></script>

        <script>
            @if(Session::has('passwordSalah'))
                alertify.error("Kata Sandi Tidak Sesuai Dengan Profil Anda!");
            @endif
        </script>

        <script>
            @if(Session::has('jail'))
                alertify.error("Buka Layar Terlebih Dahulu!");
            @endif
        </script>
    </body>

</html>