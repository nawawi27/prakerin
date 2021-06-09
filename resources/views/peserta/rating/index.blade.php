@extends('layouts.master')

@section('title','Rating')

@section('css')
<!-- Bootstrap rating css -->
<link href="{{asset('admin/plugins/bootstrap-rating/bootstrap-rating.css')}}" rel="stylesheet" type="text/css">
@stop

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

@section('content')
@if(auth()->user()->peserta->perusahaan_id != NULL)
    @if(count($rating) == 0)
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card m-b-20">
                <form action="{{ route('rating.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $jquin->id }}" name="perusahaan_id">
                <input type="hidden" value="{{ auth()->user()->peserta->id }}" name="peserta_id">
                <div class="card-body">
                    <p class="text-muted m-b-5">Berikan penilaian anda terhadap perusahaan.</p>
                    <hr>              
                    <dl class="row text-left m-t-20">
                        <dt class="col-sm-5">Nama Perusahaan</dt>
                        <dd class="col-sm-7">{{ $jquin->nama_perusahaan }}</dd>

                        <dt class="col-sm-5">Bidang Usaha</dt>
                        <dd class="col-sm-7">{{ $jquin->bidang_usaha }}</dd>

                        <dt class="col-sm-5">Rating</dt>
                        <dd class="col-sm-7">
                            <input type="hidden" class="rating-tooltip" data-filled="mdi mdi-star font-32 text-primary" name="rating" data-empty="mdi mdi-star-outline font-32 text-muted" value="1" />
                        </dd>

                        <dt class="col-sm-5">Ulasan</dt>
                        <dd class="col-sm-7">
                            <textarea name="ulasan" required="" id="textarsea" cols="30" rows="3" class="form-control" placeholder="Masukkan Ulasan..." maxlength="225"></textarea>
                        </dd>
                    </dl>
                </div>
                <div class="card-footer bg-white">
                    <div class="float-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card m-b-20">
                <div class="card-body">
                    <p class="text-muted m-b-5">Penilaian anda terhadap perusahaan.</p>
                    <hr>              
                    <dl class="row text-left m-t-20">
                        @foreach($rating as $neko)
                        <dt class="col-sm-5">Nama Perusahaan</dt>
                        <dd class="col-sm-7">{{ $neko->perusahaan->nama_perusahaan }}</dd>

                        <dt class="col-sm-5">Bidang Usaha</dt>
                        <dd class="col-sm-7">{{ $neko->perusahaan->bidang_usaha }}</dd>

                        <dt class="col-sm-5">Rating</dt>
                        <dd class="col-sm-7">
                            <input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" disabled="disabled" value="{{ $neko->rating }}"/>
                        </dd>

                        <dt class="col-sm-5">Ulasan</dt>
                        <dd class="col-sm-7">{{ $neko->ulasan }}</dd>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    @endif
@else
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">Anda belum memiliki tempat prakerin!</div>
    </div>
</div>
@endif
@stop

@section('footer')
<!-- Bootstrap rating js -->
<script src="{{asset('admin/plugins/bootstrap-rating/bootstrap-rating.min.js')}}"></script>
<script src="{{asset('admin/pages/rating-init.js')}}"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
@stop