@extends('layouts.master')

@section('title','Dashboard Peserta')

@section('search')
<div class="search-wrap" id="search-wrap">
    <div class="search-bar">
        <form action="{{ route('informasi.search') }}" method="POST">
            @csrf
            <input class="search-input" type="search" placeholder="Cari Informasi..." name="q" />
        </form>
        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
            <i class="mdi mdi-close-circle"></i>
        </a>
    </div>
</div>
@stop

@section('notifikasi')
<li class="list-inline-item dropdown notification-list">
    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        <i class="ion-ios7-bell noti-icon"></i>
        @if(count($informasi) > 0)
            <span class="badge badge-danger noti-icon-badge">{{ $informasi->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
         <!-- item -->
        <div class="dropdown-item noti-title">
            <h5>Notifikasi</h5>
        </div>

        @foreach($informasi as $notif)
         <!-- item -->
        <a href="{{ route('peserta.infoshow', $notif->id) }}" class="dropdown-item notify-item active">
            <div class="notify-icon bg-success"><i class="ti-announcement"></i></div>
            <p class="notify-details"><b>{{ $notif->judul }}</b><small class="text-muted">Informasi</small></p>
        </a>
        @endforeach

         <!-- All -->
        <a href="{{ route('peserta.informasi') }}" class="dropdown-item notify-item">
            Lihat Semua
        </a>
    </div>
</li>
@stop

@section('content')
@if(auth()->user()->peserta->status == '0')
<div class="row justify-content-center">
    <div class="col-md-8">
       <div class="card">
           <div class="card-body">
                <div class="card-title text-center">
                    Hallo {{ auth()->user()->nama_lengkap }}, Silahkan lengkapi data pribadi terlebih dahulu untuk melanjutkan.
                </div>
                <hr>
                <form action="{{ route('peserta.biodata') }}" method="POST">  
                    @csrf                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" class="form-control" id="password" placeholder="Masukkan Password Baru" required="" name="password">
                                <code class="highlighter-rouge">*Perbarui Password Anda!</code>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl">Tempat, Tanggal Lahir</label>
                                <input type="ttl" class="form-control" id="ttl" placeholder="Masukkan Tempat, Tanggal Lahir" required="" name="ttl">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tlp_peserta">No Telpon Peserta</label>
                                <input type="number" class="form-control" name="tlp_peserta" id="tlp_peserta" placeholder="Masukkan No Telpon Anda" required="" maxlength="15">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tlp_orangtua">No Telpon Orang Tua/Wali</label>
                                <input type="number" class="form-control" name="tlp_orangtua" id="tlp_orangtua" placeholder="Masukkan No Telpon Orang Tua/Wali" required="" maxlength="15">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3" required=""></textarea>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="catatan_kesehatan">Catatan Kesehatan</label>
                                <textarea name="catatan_kesehatan" class="form-control" id="catatan_kesehatan" cols="30" rows="3"></textarea>
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>   
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </form>
           </div>
       </div> 
    </div>
</div>
@else
<div class="row justify-content-center">
    <div class="col-lg-6">
        @if(empty(auth()->user()->peserta->perusahaan_id))
        <div class="alert alert-danger">Segera ajukan tempat prakerin anda!</div>
        @endif
        <div class="card m-b-20">
            <div class="card-body">
                <div class="float-right">
                    <a href="#" data-toggle="modal" data-target="#editProfil" class="btn btn-sm btn-warning"><i class="ti-pencil"></i></a>
                </div>
                <div class="media">
                    <img class="d-flex mr-3 img-thumbnail thumb-lg" src="@if(auth()->user()->path != 'default.png'){{ asset('storage/'.auth()->user()->path) }} @else {{ asset('admin/images/users/default.png') }} @endif" alt="Poto Profil">
                    <div class="media-body">
                        <h5 class="m-t-10 font-18 mb-1">{{ auth()->user()->nama_lengkap }}</h5>
                        <p class="text-muted m-b-5">{{ auth()->user()->username }}</p>
                        <p class="text-muted font-14 font-500 font-secondary">{{ ucwords(auth()->user()->role) }}</p>
                    </div>
                </div>

                @foreach($peserta as $jquin)
                <dl class="row text-left m-t-20">
                    <dt class="col-sm-5">NIS</dt>
                    <dd class="col-sm-7">{{ $jquin->nis }}</dd>

                    <dt class="col-sm-5">Nama Lengkap</dt>
                    <dd class="col-sm-7">{{ $jquin->nama_lengkap }}</dd>

                    <dt class="col-sm-5">Jenis Kelamin</dt>
                    <dd class="col-sm-7">
                        @if($jquin->jk == 'L')
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </dd>

                    <dt class="col-sm-5">Tempat, Tanggal Lahir</dt>
                    <dd class="col-sm-7">{{ $jquin->ttl }}</dd>

                    <dt class="col-sm-5">Program Keahlian</dt>
                    <dd class="col-sm-7">{{ $jquin->grup->program_keahlian }}</dd>

                    <dt class="col-sm-5">Kompetensi Keahlian</dt>
                    <dd class="col-sm-7">{{ $jquin->grup->kompetensi_keahlian }}</dd>
                    
                    <dt class="col-sm-5">Kelas</dt>
                    <dd class="col-sm-7">{{ $jquin->grup->kelas }}</dd>

                    <dt class="col-sm-5">Tempat Prakerin</dt>
                    <dd class="col-sm-7">
                        @if($jquin->perusahaan_id != NULL)
                            {{ $jquin->perusahaan->nama_perusahaan }}
                        @else
                        - 
                        @endif
                    </dd>

                    <dt class="col-sm-5">Pembimbing Prakerin</dt>
                    <dd class="col-sm-7">
                        @if($jquin->pembimbing_id != NULL)
                            {{ $jquin->pembimbing->nama_lengkap }}
                        @else
                        - 
                        @endif
                    </dd>
                </dl>
                @endforeach
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endif

<!-- Modal -->
<x-editProfil></x-editProfil>
@stop

@section('footer')
<script src="{{asset('admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
@stop