@extends('layouts.master')

@section('title','Informasi')

@section('content')
<div class="row">
    @forelse($neko as $jquin)
    <div class="col-md-4">
        <!-- Simple card -->
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">{{ $jquin->judul }}</h4>
                <p class="card-text">{!! Str::limit($jquin->artikel, 100, '.. <a href="/informasi/'.$jquin->id.'/artikel" target="_blank">Selengkapnya</a>') !!}</p>
                <hr>
                <p class="card-text">
                    <i class="ti-user"></i> <small class="text-muted">{{ $jquin->user->nama_lengkap }}</small>
                    <i class="ti-calendar ml-2"></i> <small class="text-muted">{{ $jquin->created_at->format('d F Y H:i:s') }}</small>
                </p>
            </div>
        </div>
    </div> <!-- end col -->
    @empty
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            Tidak ada informasi terbaru!
        </div>
    </div>
    @endforelse
</div> <!-- end row -->
@stop

@section('footer')

@stop