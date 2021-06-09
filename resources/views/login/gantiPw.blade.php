<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Monitoring - Ganti Kata Sandi</title>
    <meta content="E-learning" name="Ganti Kata Sandi" />
    <meta content="" name="author" />
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
                    <a href="{{ url()->previous() }}" class="text-dark mt-2">Logo<a>
                    <!-- <a href="" class="logo logo-admin"><img src="" height="30" alt="logo"></a> -->
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Ganti Kata Sandi</h4>
                    <p class="text-muted text-center">Masukkan Kata Sandi Lama Dan Kata Sandi Baru.</p>

                    <form class="form-horizontal m-t-30" action="{{ route('update.pw') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="sandiLama">Kata Sandi Lama</label>
                            <input type="password" class="form-control" name="sandiLama" id="sandiLama" required="" placeholder="Masukkan Kata Sandi Lama">
                        </div>

                        <div class="form-group">
                            <label for="sandiBaru">Kata Sandi Baru</label>
                            <input type="password" name="sandiBaru" required="" class="form-control" id="sandiBaru" placeholder="Masukkan Kata Sandi" minlength="8">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="m-t-40 text-center">
            <p>© {{ date('Y') }} Dikembangkan Oleh Roni Surya.
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

    <!-- Parsley js -->
    <script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>

    <!-- Alert -->
    <script>
        @if(Session::has('errorPw'))
            alertify.error("Kata Sandi Lama Tidak Sesuai!");
        @endif
    </script>

</body>
</html>