<div class="topbar">

    <nav class="navbar-custom">
        @if(auth()->user()->role == 'pembimbing')
        <ul class="list-inline float-right mb-0">
            <!-- Fullscreen -->
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen noti-icon"></i>
                </a>
            </li>
            <!-- notification-->
            @yield('notifikasi')
            <!-- User-->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="@if(auth()->user()->path == 'default.png') {{ asset('admin/images/users/default.png') }} @else {{ asset('storage/'.auth()->user()->path) }} @endif" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <span class="text-info dropdown-item">
                        {{ auth()->user()->nama_lengkap }}
                    </span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('ganti.pw') }}"><i class="mdi mdi-lock-outline text-muted"></i> Ganti Kata Sandi</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit text-muted"></i> Keluar</a>
                </div>
            </li>
        </ul>
        @endif

        @if(auth()->user()->role == 'peserta')
        <!-- Search input -->
        @yield('search')
        <ul class="list-inline float-right mb-0">
            <!-- Search -->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                    <i class="mdi mdi-magnify noti-icon"></i>
                </a>
            </li>
            <!-- Fullscreen -->
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen noti-icon"></i>
                </a>
            </li>
            <!-- notification-->
            @yield('notifikasi')
            <!-- User-->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="@if(auth()->user()->path == 'default.png') {{ asset('admin/images/users/default.png') }} @else {{ asset('storage/'.auth()->user()->path) }} @endif" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <span class="text-info dropdown-item">
                        {{ auth()->user()->nama_lengkap }}
                    </span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('ganti.pw') }}"><i class="mdi mdi-lock-outline text-muted"></i> Ganti Kata Sandi</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit text-muted"></i> Keluar</a>
                </div>
            </li>
        </ul>
        @elseif(auth()->user()->role == 'admin')
        <ul class="list-inline float-right mb-0">
            <!-- Fullscreen -->
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen noti-icon"></i>
                </a>
            </li>
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="@if(auth()->user()->path == 'default.png') {{ asset('admin/images/users/default.png') }} @else {{ asset('storage/'.auth()->user()->path) }} @endif" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <span class="text-info dropdown-item">
                        {{ auth()->user()->nama_lengkap }}
                    </span>
                    <div class="dropdown-divider"></div>
                    @if(auth()->user()->role == 'admin')
                    <a class="dropdown-item" href="{{ route('pengguna.profil') }}"><i class="ti-user text-muted"></i> Profil</a>
                    <a class="dropdown-item" href="{{ route('kunci.layar') }}"><i class="ti-time text-muted"></i> Kunci Layar</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('ganti.pw') }}"><i class="mdi mdi-lock-outline text-muted"></i> Ganti Kata Sandi</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit text-muted"></i> Keluar</a>
                </div>
            </li>
        </ul>
        @endif

        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">@yield('text')</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>