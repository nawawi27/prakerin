@extends('layouts.master')

@section('title','Edit Pengajuan Perusahaan Baru')

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
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h5 class="mt-0 header-title">Maps (Opsional)</h5>
                <div id="mapContainer" style="height: 600px;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <span class="mt-0 header-title">Edit Pengajuan Perusahaan Baru</span>
                <hr>
                <form action="{{ route('pes.uppr', $rekomendasi->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" required="" maxlength="60" name="nama_perusahaan" id="nama_perusahaan" placeholder="Masukkan Nama Perusahaan" value="{{ $rekomendasi->nama_perusahaan }}">
                    </div>

                    <div class="form-group">
                        <label for="pemilik_perusahaan">Pemilik Perusahaan</label>
                        <input type="text" class="form-control" maxlength="60" required="" name="pemilik_perusahaan" id="pemilik_perusahaan" placeholder="Masukkan Pemilik Perusahaan" value="{{ $rekomendasi->pemilik_perusahaan }}">
                    </div>

                    <div class="form-group">
                        <label for="bidang_usaha">Bidang Usaha</label>
                        <input type="text" class="form-control" maxlength="60" required="" name="bidang_usaha" id="bidang_usaha" placeholder="Masukkan Bidang Usaha" value="{{ $rekomendasi->bidang_usaha }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tlp_perusahaan">No Telpon Perusahaan</label>
                                <input type="number" class="form-control" maxlength="15" required="" name="tlp_perusahaan" id="tlp_perusahaan" placeholder="Masukkan Telpon Perusahaan" value="{{ $rekomendasi->tlp_perusahaan }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kuota">Kuota Peserta</label>
                                <input type="number" maxlength="2" class="form-control" required="" name="kuota" id="kuota" placeholder="Masukkan Kuota Peserta" value="{{ $rekomendasi->kuota }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="lat" readonly="" value="{{ $rekomendasi->latitude }}">
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="lng" readonly="" value="{{ $rekomendasi->longitude }}">
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat Perusahaan</label>
                        <textarea name="alamat" id="" cols="30" rows="5" required="" class="form-control">{{ $rekomendasi->alamat }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div> <!-- end row -->
<br>
@stop

@section('footer')
<!-- Here Maps -->
<script type="text/javascript" src="{{asset('admin/js/here.js')}}"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<!-- Key Api -->
<script>
    window.hereApiKey = "{{ env('HERE_API_KEY') }}"
    window.action = "submit"
</script>
@stop