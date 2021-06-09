@extends('layouts.master')

@section('title','Perusahaan')

@section('css')

@stop

@section('search')
<div class="search-wrap" id="search-wrap">
    <div class="search-bar">
        <form action="{{ route('pengajuan.search') }}" method="POST">
            @csrf
            <input class="search-input" type="search" placeholder="Cari Perusahaan..." name="q" />
        </form>
        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
            <i class="mdi mdi-close-circle"></i>
        </a>
    </div>
</div>
@stop

@section('content')
@if(auth()->user()->peserta->status != 0)
    @if(count($terverifikasi) > 0)
        <div class="row justify-content-center">
            @foreach($terverifikasi as $neko)
            <div class="col-md-6">
                <div class="alert alert-success">Anda sudah mendapatkan tempat prakerin.</div>
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="font-20 mt-0">{{ $neko->perusahaan->nama_perusahaan }}</h4>
                        </div>
                        <hr>
                        <dl class="row text-left m-t-20">
                            <dt class="col-sm-4">Nama Perusahaan</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->nama_perusahaan }}</dd>

                            <dt class="col-sm-4">Pemilik Perusahaan</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->pemilik_perusahaan }}</dd>

                            <dt class="col-sm-4">Bidang Usaha</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->bidang_usaha }}</dd>

                            <dt class="col-sm-4">No Telpon</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->tlp_perusahaan }}</dd>

                            <dt class="col-sm-4">Alamat</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->alamat }}</dd>

                            <dt class="col-sm-4">Tanggal Prakerin</dt>
                            <dd class="col-sm-8">{{ $neko->tgl() }}</dd>

                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8"><span class="badge badge-success">Diverifikas</span></dd>

                            <dt class="col-sm-4">Lokasi Prakerin</dt>
                            <dd class="col-sm-8"><a href="#" onclick="tampilDetail({{ $neko->perusahaan->latitude }}, {{ $neko->perusahaan->longitude }}, {{ $neko->perusahaan->id }})" class="btn btn-sm btn-info"><i class="ti-location-pin"></i></a></dd>
                        </dl>
                    </div>
                </div>
            </div> <!-- end col -->
            @endforeach
        </div>
    @else
        @if(count($peserta) > 0)
        <div class="row justify-content-center">
            @foreach($peserta as $neko)
            <div class="col-md-6">
                <div class="alert alert-info">Anda sudah mengajukan tempat prakerin, tunggu verifikasi dari admin!</div>
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="float-right">
                                <a href="{{ route('pengajuan.edit', $neko->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Pengajuan"><i class="ti-pencil"></i></a>
                                <a href="#" onclick="destroy({{ $neko->id }})" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Pengajuan"><i class="ti-trash"></i></a>
                            </div>
                            <h4 class="font-20 mt-0">{{ $neko->perusahaan->nama_perusahaan }}</h4>
                        </div>
                        <hr>
                        <dl class="row text-left m-t-20">
                            <dt class="col-sm-4">Nama Perusahaan</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->nama_perusahaan }}</dd>

                            <dt class="col-sm-4">Pemilik Perusahaan</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->pemilik_perusahaan }}</dd>

                            <dt class="col-sm-4">Bidang Usaha</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->bidang_usaha }}</dd>

                            <dt class="col-sm-4">No Telpon</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->tlp_perusahaan }}</dd>

                            <dt class="col-sm-4">Alamat</dt>
                            <dd class="col-sm-8">{{ $neko->perusahaan->alamat }}</dd>

                            <dt class="col-sm-4">Tanggal Prakerin</dt>
                            <dd class="col-sm-8">{{ $neko->tgl() }}</dd>

                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8"><span class="badge badge-info">{{ $neko->status }}</span></dd>

                            <dt class="col-sm-4">Lokasi</dt>
                            <dd class="col-sm-8"><a href="#" onclick="tampilDetail({{ $neko->perusahaan->latitude }}, {{ $neko->perusahaan->longitude }}, {{ $neko->perusahaan->id }})" class="btn btn-sm btn-info"><i class="ti-location-pin"></i></a></dd>
                        </dl>
                    </div>
                </div>
            </div> <!-- end col -->
            @endforeach
        </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Perusahaan</h4>
                            <small class="text-muted">Perusahaan dibawah ini adalah perusahaan yang telah menjalin kerjasama dengan sekolah.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
            @forelse($perusahaan as $jquin)
            {{-- Hitung Kuota --}}
            @php
            $kuota = $jquin->kuota;
            $diterima = $jquin->peserta->count();
            $sisa = $kuota - $diterima;
            @endphp
                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="card-title">
                                @if($sisa >= 1)
                                <div class="float-right">
                                    <a href="{{ route('pengajuan.create', $jquin->id) }}" class="btn btn-sm btn-primary"><i class="dripicons-direction"></i> Ajukan</a>
                                </div>
                                @endif
                                <h4 class="font-20 mt-0">{{ $jquin->nama_perusahaan }}</h4>
                            </div>
                            <hr>
                            <dl class="row text-left m-t-20">
                                <dt class="col-sm-4">Nama Perusahaan</dt>
                                <dd class="col-sm-8">{{ $jquin->nama_perusahaan }}</dd>

                                <dt class="col-sm-4">Pemilik Perusahaan</dt>
                                <dd class="col-sm-8">{{ $jquin->pemilik_perusahaan }}</dd>

                                <dt class="col-sm-4">Bidang Usaha</dt>
                                <dd class="col-sm-8">{{ $jquin->bidang_usaha }}</dd>

                                <dt class="col-sm-4">No Telpon</dt>
                                <dd class="col-sm-8">{{ $jquin->tlp_perusahaan }}</dd>

                                <dt class="col-sm-4">Alamat</dt>
                                <dd class="col-sm-8">{{ $jquin->alamat }}</dd>

                                <dt class="col-sm-4">Lokasi</dt>
                                <dd class="col-sm-8"><a href="#" onclick="tampilDetail({{ $jquin->latitude }}, {{ $jquin->longitude }}, {{ $jquin->id }})" class="btn btn-sm btn-info"><i class="ti-location-pin"></i></a></dd>
                            </dl>
                            <hr>
                            <p class="card-text">
                                {{-- Cek Kuota --}}
                                @if($sisa >= 1)
                                <small class=" text-info">Kuota {{ $jquin->kuota }} Peserta, Sisa {{ $sisa }} Peserta.</small>
                                @else
                                <span class="badge badge-info">Kuota Penuh</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div> <!-- end col -->
            @empty
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    Tidak ada perusahaan yang dapat diajukan!
                </div>
            </div>
            @endforelse
            </div> <!-- end row -->
        @endif
    @endif
@else
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">Lengkapi data pribadi anda terlebih dahulu, untuk dapat mengakses halaman ini!</div>
    </div>
</div>
@endif
@stop

@section('footer')
<script type="text/javascript" src="{{asset('admin/js/here.js')}}"></script>

<script>
    function destroy(id) {
        alertify.confirm("Hapus Pengajuan?", function (ev) {
            ev.preventDefault();
            window.location = "pengajuan/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop