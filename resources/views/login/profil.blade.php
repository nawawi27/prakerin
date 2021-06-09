@extends('layouts.master')

@section('title','Pengguna Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="float-right">
                    <a href="#" data-toggle="modal" data-target="#editProfil" class="btn btn-sm btn-warning"><i class="ti-pencil"></i></a>
                </div>
                <div class="media">
                    <img class="d-flex mr-3 img-thumbnail thumb-lg" src="@if(auth()->user()->path != 'default.png'){{ asset('storage/'.auth()->user()->path) }} @else {{ asset('admin/images/users/default.png') }} @endif" alt="Poto Profil">
                    <div class="media-body">
                        <h5 class="m-t-10 font-18 mb-1">{{ auth()->user()->nama_lengkap }}</h5>
                        <p class="text-muted m-b-5">{{ Auth()->user()->username }}</p>
                        <p class="text-muted font-14 font-500 font-secondary"></p>
                    </div>
                </div>

                <dl class="row text-left m-t-20">
                    <dt class="col-sm-5">Nama Lengkap</dt>
                    <dd class="col-sm-7">{{ auth()->user()->nama_lengkap }}</dd>

                    <dt class="col-sm-5">Nama Pengguna</dt>
                    <dd class="col-sm-7">{{ auth()->user()->username }}</dd>
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