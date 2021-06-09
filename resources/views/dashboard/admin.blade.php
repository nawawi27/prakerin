@extends('layouts.master')

@section('title','Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-purple">{{ $peserta }}</h3>
                Total Peserta
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-info">{{ $rekapitulasi }}</h3>
                Total Rekapitulasi Peserta
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-primary">{{ $rekomendasi }}</h3>
                Total Pengajuan Perusahaan
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-danger">{{ $pengajuan }}</h3>
                Total Pengajuan Peserta
            </div>
        </div>
    </div>
    <!-- Line Two -->
    <div class="col-md-6 col-xl-3">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-primary">{{ $pembimbing }}</h3>
                Total Pembimbing
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-info">{{ $perusahaan }}</h3>
                Total Perusahaan
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')

@stop