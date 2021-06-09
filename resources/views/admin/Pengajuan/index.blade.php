@extends('layouts.master')

@section('title','Pengajuan Peserta Prakerin')

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
                <h4 class="mt-0 header-title">Pengajuan Peserta Prakerin</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Perusahaan</th>
                            <th>No Telpon Perusahaan</th>
                            <th>Total Peserta Mengajukan</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nama_perusahaan }}</td>
                            <td>{{ $jquin->tlp_perusahaan }}</td>
                            <td>{{ $jquin->total }} Peserta</td>
                            <td>
                                <a href="{{ route('pengajuan.show', $jquin->perusahaan_id) }}" target="_blank" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail pengajuan"><i class="ti-eye"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->perusahaan_id }},'{{ $jquin->nama_perusahaan }}')" data-toggle="tooltip" data-placement="top" title="Hapus semua peserta yang mengajukan" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><b><i>Tidak Ada Data</i></b></td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@stop

@section('footer')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>

<script>
$().DataTable();
</script>

<!-- Destroy -->
<script>
    function destroy(id,nama) {
        alertify.confirm("Hapus Pengajuan Perusahaan "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "pengajuan/"+ id +"/destroy/admin";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop