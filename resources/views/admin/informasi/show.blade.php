@extends('layouts.master')

@section('title')
    {{ $informasi->judul }}
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <p class="card-text">
                    <i class="ti-user"></i> <small class="text-muted">{{ $informasi->user->nama_lengkap }}</small>
                    <i class="ti-calendar ml-2"></i> <small class="text-muted">{{ $informasi->created_at->format('d F Y H:i:s') }}</small>
                </p>
                <h4 class="card-title font-20 mt-0">{{ $informasi->judul }}</h4>
                <p class="card-text">
                    {!! $informasi->artikel !!}
                </p>
                @if($informasi->path != NULL)
                <p class="card-text">
                    <small class="text-muted">File : <i class="ti-file"></i>  <a href="{{ route('informasi.download', $informasi->id) }}">Download</a></small>
                </p>
                @endif
            </div>
        </div>
    </div>
</div> <!-- end row -->
@stop

@section('footer')

@stop