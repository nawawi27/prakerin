@extends('layouts.master')

@section('title')
Profil Peserta {{ $peserta->nama_lengkap }}
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">

                <div class="media">
                    <img class="d-flex mr-3 img-thumbnail thumb-lg" src="@if($peserta->user->path != 'default.png'){{ asset('storage/'.$peserta->user->path) }} @else {{ asset('admin/images/users/default.png') }} @endif" alt="Poto Profil">
                    <div class="media-body">
                        <h5 class="m-t-10 font-18 mb-1">{{ $peserta->nama_lengkap }}</h5>
                        <p class="text-muted m-b-5">{{ $peserta->grup->program_keahlian }}</p>
                        <p class="text-muted font-14 font-500 font-secondary">{{ $peserta->grup->kelas }}</p>
                    </div>
                </div>

                <dl class="row text-left m-t-20">
                    <dt class="col-sm-5">NIS</dt>
                    <dd class="col-sm-7">{{ $peserta->nis }}</dd>

                    <dt class="col-sm-5">Nama Lengkap</dt>
                    <dd class="col-sm-7">{{ $peserta->nama_lengkap }}</dd>

                    <dt class="col-sm-5">Nama Pengguna</dt>
                    <dd class="col-sm-7">{{ $peserta->user->username }}</dd>

                    <dt class="col-sm-5">TTL</dt>
                    <dd class="col-sm-7">{{ $peserta->ttl }}</dd>

                    <dt class="col-sm-5">Jenis Kelamin</dt>
                    <dd class="col-sm-7">
                        @if($peserta->jk == 'L')
                        Laki-Laki
                        @else
                        Perempuan
                        @endif
                    </dd>

                    <dt class="col-sm-5">Telpon Peserta</dt>
                    <dd class="col-sm-7">{{ $peserta->tlp_peserta }}</dd>

                    <dt class="col-sm-5">Telpon Orang Tua</dt>
                    <dd class="col-sm-7">{{ $peserta->tlp_orangtua }}</dd>

                    <dt class="col-sm-5">Catatan Kesehatan</dt>
                    <dd class="col-sm-7">@if($peserta->catatan_kesehatan != NULL) {{ $peserta->catatan_kesehatan }} @else - @endif</dd>

                    <dt class="col-sm-5">Alamat</dt>
                    <dd class="col-sm-7">{{ $peserta->alamat }}</dd>
                </dl>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@stop
