@extends('layouts.master')

@section('title','Detail Perusahaan')

@section('css')
<!-- Here Maps -->
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<!-- Titik Koordinat -->
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="mt-0 header-title">Maps</h5>
                <div id="mapContainer" style="height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="mt-0 header-title">Detail Perusahaan</h5>
                <dl class="row text-left m-t-20">
                    <dt class="col-sm-4">Nama Perusahaan</dt>
                    <dd class="col-sm-8">{{ $perusahaan->nama_perusahaan }}</dd>

                    <dt class="col-sm-4">Pemilik Perusahaan</dt>
                    <dd class="col-sm-8">{{ $perusahaan->pemilik_perusahaan }}</dd>

                    <dt class="col-sm-4">Bidang Usaha</dt>
                    <dd class="col-sm-8">{{ $perusahaan->bidang_usaha }}</dd>

                    <dt class="col-sm-4">No Telpon</dt>
                    <dd class="col-sm-8">{{ $perusahaan->tlp_perusahaan }}</dd>

                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8">{{ $perusahaan->alamat }}</dd>

                    <hr>

                    <dt class="col-sm-4">Maps</dt>
                    <dd class="col-sm-8" id="ringkasan"></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<!-- Here Maps -->
<script type="text/javascript" src="{{asset('admin/js/here.js')}}"></script>
<!-- Key Api -->
<script>
    window.hereApiKey = "{{ env('HERE_API_KEY') }}";
    window.action = "detail"
</script>
@stop