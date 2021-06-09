@extends('layouts.master')

@section('title','Edit Data')

@section('css')
<link href="{{asset('admin/plugins/summernote/summernote.css')}}" rel="stylesheet" />
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <h4 class="mt-0 header-title">Edit Data</h4>
                <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" maxlength="191" class="form-control" value="{{ $informasi->judul }}" name="judul" id="judul" required="" placeholder="Masukkan Judul">
                    </div>

                    <div class="form-group">
                        <label for="artikel">Artikel</label>
                        <textarea name="artikel" id="artikel" class="summernote form-control" required="">{{ $informasi->artikel }}</textarea>
                    </div>

                    @if($informasi->path != NULL)
                    <div class="form-group">
                        <label for="">File Sebelumnya</label>
                        <br>
                        <span class="text-muted"><i class="ti-file"></i> <a href="{{ route('informasi.download', $informasi->id) }}">Download</a></span>

                        <input type="hidden" name="fileOri" value="{{ $informasi->path }}">
                    </div>
                    @else
                        <input type="hidden" name="fileOri" value="{{ $informasi->path }}">
                    @endif

                    <div class="form-group">
                        <label for="path">File</label>
                        <input type="file" class="filestyle" name="path" id="path" data-input="false" data-buttonname="btn-secondary btn-sm">
                        <code class="highlighter-rouge">*Boleh Kosong</code>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@stop

@section('footer')
<script src="{{asset('admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>
<!--Summernote js-->
<script src="{{asset('admin/plugins/summernote/summernote.min.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<script>
    jQuery(document).ready(function(){
        $('.summernote').summernote({
            height: 300,                 // Tinggi Editor
            minHeight: null,             // Mai tinggi editor
            maxHeight: null,             // Max tinggi editor
            focus: true                 // set focus edittable
        });
    });
</script>
@stop