@extends('layouts.master')

@section('title','Dashboard Admin')

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
<div class="row justify-content-center">
    <div class="col-lg-6">
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

                <dl class="row text-left m-t-20">
                    <dt class="col-sm-5">Nama Lengkap</dt>
                    <dd class="col-sm-7">{{ $jquin->nama_lengkap }}</dd>

                    <dt class="col-sm-5">Nama Pengguna</dt>
                    <dd class="col-sm-7">{{ $jquin->user->username }}</dd>

                    <dt class="col-sm-5">Kata Sandi</dt>
                    <dd class="col-sm-7">********</dd>

                    <dt class="col-sm-5">Total Peserta</dt>
                    <dd class="col-sm-7">{{ $jquin->peserta->count() }} Peserta</dd>
                </dl>
            </div>
        </div>
    </div> <!-- end col -->
</div>

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