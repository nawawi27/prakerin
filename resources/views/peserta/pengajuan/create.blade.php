@extends('layouts.master')

@section('title','Pengajuan')

@section('css')

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Pengajuan Tempat Prakerin</h4>
                <hr>
                <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $perusahaan->id }}" id="id" name="perusahaan_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="nama_perusahaan" readonly="" value="{{ $perusahaan->nama_perusahaan }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Pemilik Perusahaan</label>
                                <input type="text" class="form-control" name="pemilik_perusahaan" readonly="" value="{{ $perusahaan->pemilik_perusahaan }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Bidang Usaha</label>
                                <input type="text" class="form-control" name="bidang_usaha" readonly="" value="{{ $perusahaan->bidang_usaha }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telpon Perusahaan</label>
                                <input type="text" class="form-control" name="tlp_perusahaan" readonly="" value="{{ $perusahaan->tlp_perusahaan }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat">Alamat Perusahaan</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="4" readonly="" class="form-control">{{ $perusahaan->alamat }}</textarea> 
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Mulai Prakerin</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tanggal_mulai" placeholder="mm/dd/yyyy" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Selesai Prakerin</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tanggal_selesai" placeholder="mm/dd/yyyy" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="path">Surat Pengajuan Prakerin</label>
                                <input type="file" class="filestyle" data-input="false" data-buttonname="btn-secondary btn-sm" name="path" id="path" required="" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-primary" type="submit">Ajukan</button>
                </form>
            </div>
        </div>
    </div>
</div>
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