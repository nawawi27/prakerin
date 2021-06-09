@extends('layouts.master')

@section('title','Tambah Data')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <span class="mt-0 header-title">Tambah Data</span>
                <hr>
                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="number" class="form-control" required="" placeholder="Masukkan NIS" maxlength="15" name="nis" id="nis">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" required="" maxlength="60" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Nama Pengguna</label>
                                <input type="text" class="form-control" required="" placeholder="Masukkan Nama Pengguna" maxlength="60" name="username" id="username">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control">
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ttl">Tempat, Tanggal Lahir</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat, Tanggal Lahir" maxlength="60" name="ttl" id="ttl">
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tlp_peserta">No Telpon Peserta</label>
                                <input type="number" class="form-control" placeholder="Masukkan No Telpon Peserta" maxlength="20" name="tlp_peserta" id="tlp_peserta">
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tlp_orangtua">No Telpon Orang Tua</label>
                                <input type="number" class="form-control" placeholder="Masukkan No Telpon Orang Tua" maxlength="20" name="tlp_orangtua" id="tlp_orangtua">
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="3" class="form-control"></textarea>
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="catatan_kesehatan">Catatan Kesehatan</label>
                                <textarea name="catatan_kesehatan" id="" cols="30" rows="3" class="form-control"></textarea>
                                <code class="highlighter-rouge">*Boleh Kosong</code>
                            </div>   
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- end row -->
<br>
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