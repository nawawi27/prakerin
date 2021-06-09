@extends('layouts.master')

@section('title','Detail Peserta')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="float-right">
                    @if($jquin->nilai_jurnal == NULL)
                    <a href="#" data-toggle="modal" data-target="#nilai" class="btn btn-sm btn-primary"><i class="ti-pencil-alt"></i></a>
                    @else
                    <a href="#" data-toggle="modal" data-target="#editNilai" class="btn btn-sm btn-warning"><i class="ti-pencil-alt"></i></a>
                    @endif
                </div>
                <div class="media">
                    <img class="d-flex mr-3 img-thumbnail thumb-lg" src="@if($jquin->user->path != 'default.png'){{ asset('storage/'.$jquin->user->path) }} @else {{ asset('admin/images/users/default.png') }} @endif" alt="Poto Profil">
                    <div class="media-body">
                        <h5 class="m-t-10 font-18 mb-1">{{ $jquin->nama_lengkap }}</h5>
                        <p class="text-muted m-b-5">{{ $jquin->nis }}</p>
                        <p class="text-muted font-14 font-500 font-secondary">{{ $jquin->grup->kelas }}</p>
                    </div>
                </div>

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
                </dl>

                @if($jquin->nilai_jurnal != NULL)
                <div class="row text-center m-t-20">
                    <div class="col-6">
                        <h5 class="mb-0">{{ $jquin->nilai_jurnal }}</h5>
                        <p class="text-muted font-14">Nilai Jurnal</p>
                    </div>
                    <div class="col-6">
                        <h5 class="mb-0">{{ $jquin->nilai_presentasi }}</h5>
                        <p class="text-muted font-14">Nilai Presentasi</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div> <!-- end col -->
</div>

<!-- Modal -->
@if($jquin->nilai_jurnal == NULL)
    @include('components.nilai')
@else
    @include('components.editNilai')
@endif
@stop

@section('footer')
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
@stop