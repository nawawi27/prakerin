@extends('layouts.master')

@section('title','Detail Pengajuan')

@section('css')
<!-- DataTables -->
<link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('admin/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Detail Pengajuan</h4>
                <br>
                <div class="table-responsive">
                    <form action="{{ route('pengajuan.terimaSemuaPengajuan') }}" method="POST">
                    @csrf
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="checkAll">
                            </th>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Program Keahlian</th>
                            <th>Kelas</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>
                                <input type="checkbox" name="pilih[]" class="pilih" value="{{ $jquin->peserta->id }}" required="">
                                <input type="hidden" name="perusahaan[]" value="{{ $jquin->perusahaan_id }}">
                                <input type="hidden" name="tanggal_mulai[]" value="{{ $jquin->tanggal_mulai }}">
                                <input type="hidden" name="tanggal_selesai[]" value="{{ $jquin->tanggal_selesai }}">
                                <input type="hidden" name="pengajuan_id[]" value="{{ $jquin->id }}">
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->peserta->nama_lengkap }}</td>
                            <td>{{ $jquin->peserta->grup->program_keahlian }}</td>
                            <td>{{ $jquin->peserta->grup->kelas }}</td>
                            <td>{{ date('d F Y', strtotime($jquin->tanggal_mulai)) }}</td>
                            <td>{{ date('d F Y', strtotime($jquin->tanggal_selesai)) }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-path="{{ $jquin->path }}" data-target="#surat" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Surat Pengajuan {{ $jquin->peserta->nama_lengkap }}"><i class="ti-email"></i></a>
                                <a href="{{ route('pengajuan.terimaPengajuan', $jquin->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi Pengajuan {{ $jquin->peserta->nama_lengkap }}"><i class="ti-check"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{ $jquin->peserta->nama_lengkap }}')" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"><b><i>Tidak Ada Data</i></b></td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if(count($neko) > 0)
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary" type="submit">Konfirmasi Semua Pengajuan</button>
                    </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<x-surat></x-surat>
@stop

@section('footer')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>

<script>
$().DataTable();
</script>

<x-showsurat></x-showsurat>
<!-- Destroy -->
<script>
    function destroy(id,nama) {
        alertify.confirm("Hapus Pengajuan "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "{{ url('admin/satu/pengajuan/destroy') }}"+ '/' + id;

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>

<!-- Check -->
<script>
    // Check All
    $('.checkAll').on('change', function(e) {
        e.preventDefault();
        $('.pilih').prop('checked', this.checked);
    });
</script>
@stop