<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            {{-- <a href="{{ url()->previous() }}" class="logo text-center">Logo</a> --}}
            <a href="{{ url()->previous() }}" class="logo"><img src="{{ asset('admin/images/image.png') }}" width="100" alt="logo" style="margin-top: 30px; margin-left:30px"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Menu</li>
                @if(auth()->user()->role == 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="dripicons-device-desktop"></i><span> Dashboard </span></a>
                </li>

                <li>
                    <a href="{{ route('berkas.index') }}" class="waves-effect"><i class="ti-folder"></i><span> Berkas </span></a>
                </li>

                <li>
                    <a href="{{ route('grup.index') }}" class="waves-effect"><i class="ti-harddrives"></i><span> Data Grup </span></a>
                </li>

                <li>
                    <a href="{{ route('pembimbing.index') }}" class="waves-effect"><i class="dripicons-user-group"></i><span> Data Pembimbing </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout-list-thumb"></i><span> Perusahaan <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('perusahaan.index') }}">Data Perusahaan</a></li>
                        <li><a href="{{ route('admin.peperu') }}">Pengajuan Perusahaan</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-card-details"></i><span> Peserta <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('peserta.index') }}">Data Peserta</a></li>
                        <li><a href="{{ route('admin.pengajuan') }}">Pengajuan Prakerin</a></li>
                        <li><a href="{{ route('admin.rekapPeserta') }}">Rekapitulasi Peserta</a></li>
                        <li><a href="{{ route('peserta.nilai') }}">Rekapitulasi Nilai Peserta</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('informasi.index') }}" class="waves-effect"><i class="ti-announcement"></i><span> Informasi </span></a>
                </li>

                <li>
                    <a href="{{ route('rating.admin') }}" class="waves-effect"><i class="ti-star"></i><span> Ulasan Peserta </span></a>
                </li>

                <li>
                    <a href="{{ route('pengguna.index') }}" class="waves-effect"><i class="ti-user"></i><span> Data Pengguna </span></a>
                </li>
                @elseif(auth()->user()->role == 'pembimbing')
                <li>
                    <a href="{{ route('pembimbing.dashboard') }}" class="waves-effect"><i class="dripicons-device-desktop"></i><span> Dashboard </span></a>
                </li>

                <li>
                    <a href="{{ route('berkasp.index') }}" class="waves-effect"><i class="ti-folder"></i><span> Berkas </span></a>
                </li>

                <li>
                    <a href="{{ route('pesertap.index') }}" class="waves-effect"><i class="ion-android-friends"></i><span> Data Peserta </span></a>
                </li>

                <li>
                    <a href="{{ route('perusahaanp.index') }}" class="waves-effect"><i class="ti-layout-list-thumb"></i><span> Data Perusahaan </span></a>
                </li>

                <li>
                    <a href="{{ route('informasip.index') }}" class="waves-effect"><i class="ti-announcement"></i><span> Informasi </span></a>
                </li>

                @else
                <li>
                    <a href="{{ route('peserta.dashboard') }}" class="waves-effect"><i class="dripicons-device-desktop"></i><span> Dashboard </span></a>
                </li>

                <li>
                    <a href="{{ route('peserta.informasi') }}" class="waves-effect"><i class="ti-announcement"></i><span> Informasi </span></a>
                </li>

                <li>
                    <a href="{{ route('pengajuan.index') }}" class="waves-effect"><i class="dripicons-direction"></i><span> Pengajuan Prakerin </span></a>
                </li>

                <li>
                    <a href="{{ route('pes.index') }}" class="waves-effect"><i class="dripicons-direction"></i><span> Pengajuan Perusahaan </span></a>
                </li>

                <li>
                    <a href="{{ route('rating.peserta') }}" class="waves-effect"><i class="ti-star"></i><span> Rating </span></a>
                </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>