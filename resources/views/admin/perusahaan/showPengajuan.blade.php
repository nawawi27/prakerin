@extends('layouts.master')

@section('title','Detail Perusahaan')

@section('css')

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="float-right">
                    <a href="{{ route('admin.konPeru', $rekomendasi->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi Pengajuan"><i class="ti-check"></i></a>
                </div>
                <h5 class="mt-0 header-title">Detail Perusahaan - {{ $rekomendasi->nama_perusahaan }}</h5>
                <hr>
                <dl class="row text-left m-t-20">
                    <dt class="col-sm-4">Nama Perusahaan</dt>
                    <dd class="col-sm-8">{{ $rekomendasi->nama_perusahaan }}</dd>

                    <dt class="col-sm-4">Pemilik Perusahaan</dt>
                    <dd class="col-sm-8">{{ $rekomendasi->pemilik_perusahaan }}</dd>

                    <dt class="col-sm-4">Bidang Usaha</dt>
                    <dd class="col-sm-8">{{ $rekomendasi->bidang_usaha }}</dd>

                    <dt class="col-sm-4">No Telpon</dt>
                    <dd class="col-sm-8">{{ $rekomendasi->tlp_perusahaan }}</dd>

                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8">{{ $rekomendasi->alamat }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8"><span class="badge badge-info">{{ $rekomendasi->status }}</span></dd>

                    <dt class="col-sm-4">Kuota</dt>
                    <dd class="col-sm-8">{{ $rekomendasi->kuota }} Peserta</dd>
                </dl>
                <h5 class="mt-0 header-title">Peserta Yang Mengajukan</h5>
                <hr>
                <dl class="row text-left m-t-20">
                    <dt class="col-sm-5">NIS</dt>
                    <dd class="col-sm-7">{{ $rekomendasi->peserta->nis }}</dd>

                    <dt class="col-sm-5">Nama Lengkap</dt>
                    <dd class="col-sm-7">{{ $rekomendasi->peserta->nama_lengkap }}</dd>

                    <dt class="col-sm-5">Jenis Kelamin</dt>
                    <dd class="col-sm-7">
                        @if($rekomendasi->peserta->jk == 'L')
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </dd>

                    <dt class="col-sm-5">Program Keahlian</dt>
                    <dd class="col-sm-7">{{ $rekomendasi->peserta->grup->program_keahlian }}</dd>

                    <dt class="col-sm-5">Kompetensi Keahlian</dt>
                    <dd class="col-sm-7">{{ $rekomendasi->peserta->grup->kompetensi_keahlian }}</dd>
                    
                    <dt class="col-sm-5">Kelas</dt>
                    <dd class="col-sm-7">{{ $rekomendasi->peserta->grup->kelas }}</dd>

                    <dt class="col-sm-5">Tempat Prakerin</dt>
                    <dd class="col-sm-7">
                        @if($rekomendasi->peserta->perusahaan_id != NULL)
                            {{ $rekomendasi->peserta->perusahaan->nama_perusahaan }}
                        @else
                        - 
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')

@stop