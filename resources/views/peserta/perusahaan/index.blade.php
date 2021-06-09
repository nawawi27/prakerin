@extends('layouts.master')

@section('title','Pengajuan Perusahaan')

@section('css')

@stop

@section('search')
<div class="search-wrap" id="search-wrap">
    <div class="search-bar">
        <form action="{{ route('perusahaan.search') }}" method="POST">
            @csrf
            <input class="search-input" type="search" placeholder="Cari Pengajuan Perusahaan..." name="q" />
        </form>
        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
            <i class="mdi mdi-close-circle"></i>
        </a>
    </div>
</div>
@stop

@section('content')
@if(count($terverifikasi) > 0)
<div class="alert alert-success">Anda sudah mendapatkan tempat prakerin.</div>
@else
    @if(count($verifikasi) > 0)
    <div class="alert alert-info">Anda sudah mengajukan tempat prakerin, tunggu verifikasi dari admin!</div>
    @else
        @if(auth()->user()->peserta->status != 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="float-right">
                            <a href="{{ route('pes.crpr') }}" class="btn btn-sm btn-primary"> Ajukan Perusahaan Baru</a>
                        </div>
                        <h4 class="mt-0 header-title">Daftar Perusahaan</h4>
                        <small class="text-muted">Perusahaan dibawah ini adalah perusahaan yang diajukan peserta prakerin.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($neko as $jquin)
                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            @if($jquin->peserta_id == auth()->user()->peserta->id)
                            <div class="float-right">
                                <a href="{{ route('pes.editpr', $jquin->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Pengajuan"><i class="ti-pencil"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }})" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Pengajuan"><i class="ti-trash"></i></a>
                            </div>
                            @endif
                            <div class="card-title">
                                <h4 class="font-20 mt-0">{{ $jquin->nama_perusahaan }}</h4>
                            </div>
                            <hr>
                            <dl class="row text-left m-t-20">
                                <dt class="col-sm-6">Peserta Yang Mengajukan</dt>
                                <dd class="col-sm-6">{{ $jquin->peserta->nama_lengkap }}</dd>
                                
                                <dt class="col-sm-6">Nama Perusahaan</dt>
                                <dd class="col-sm-6">{{ $jquin->nama_perusahaan }}</dd>

                                <dt class="col-sm-6">Pemilik Perusahaan</dt>
                                <dd class="col-sm-6">{{ $jquin->pemilik_perusahaan }}</dd>

                                <dt class="col-sm-6">Bidang Usaha</dt>
                                <dd class="col-sm-6">{{ $jquin->bidang_usaha }}</dd>

                                <dt class="col-sm-6">No Telpon</dt>
                                <dd class="col-sm-6">{{ $jquin->tlp_perusahaan }}</dd>

                                <dt class="col-sm-6">Alamat</dt>
                                <dd class="col-sm-6">{{ $jquin->alamat }}</dd>

                                <dt class="col-sm-6">Status Pengajuan</dt>
                                <dd class="col-sm-6"><span class="badge badge-info">{{ $jquin->status }}</span></dd>

                                <dt class="col-sm-6">Kuota</dt>
                                <dd class="col-sm-6">{{ $jquin->kuota }} Peserta</dd>

                                <dt class="col-sm-6">Lokasi</dt>
                                <dd class="col-sm-6"><a href="#" onclick="tampilPengajuan({{ $jquin->latitude }}, {{ $jquin->longitude }}, {{ $jquin->id }})" class="btn btn-sm btn-info"><i class="ti-location-pin"></i></a></dd>
                            </dl>
                        </div>
                    </div>
                </div> <!-- end col -->
            @empty
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    Tidak ada perusahaan yang diajukan.
                </div>
            </div>
            @endforelse
            </div> <!-- end row -->

        @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">Lengkapi data pribadi anda terlebih dahulu, untuk dapat mengakses halaman ini!</div>
            </div>
        </div>
        @endif
    @endif
@endif
@stop

@section('footer')
<script type="text/javascript" src="{{asset('admin/js/here.js')}}"></script>

<script>
    function destroy(id) {
        alertify.confirm("Hapus Pengajuan?", function (ev) {
            ev.preventDefault();
            window.location = "pengajuan/peserta/perusahaan/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop