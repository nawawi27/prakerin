@extends('layouts.master')

@section('title','Rekapitulasi Peserta Prakerin')

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
                <div class="float-right">
                    <a href="{{ route('admin.exportExcel') }}" class="btn btn-sm btn-success">Export Excel</a>
                </div>
                <h4 class="mt-0 header-title">Rekapitulasi Peserta Prakerin <br><small class="text-muted text-info">
                    Rekapitulasi peserta yang sudah mendapatkan tempat prakerin.
                </small>
                </h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>NIS</th>
                            <th>Peserta</th>
                            <th>Tempat Prakerin</th>
                            <th>Kelas</th>
                            <th>Tanggal Prakerin</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nis }}</td>
                            <td>{{ $jquin->nama_lengkap }}</td>
                            <td>{{ $jquin->perusahaan->nama_perusahaan }}</td>
                            <td>{{ $jquin->grup->kelas }}</td>
                            <td>{{ $jquin->tgl() }}</td>
                            <td>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{ $jquin->nama_lengkap }}')" data-toggle="tooltip" data-placement="top" title="Hapus Prakerin Peserta {{ $jquin->nama_lengkap }}" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>
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
        alertify.confirm("Hapus Prakerin Peserta "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "{{ url('admin/prakerin/peserta/update')}}" + '/' + id;

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop