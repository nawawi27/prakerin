@extends('layouts.master')

@section('title','Data Perusahaan Yang Diajukan Peserta')

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
                <h4 class="mt-0 header-title">Data Perusahaan Yang Diajukan Peserta</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Perusahaan</th>
                            <th>Pemilik Perusahaan</th>
                            <th>Bidang Usaha</th>
                            <th>Peserta Yang Mengajukan</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nama_perusahaan }}</td>
                            <td>{{ $jquin->pemilik_perusahaan }}</td>
                            <td>{{ $jquin->bidang_usaha }}</td>
                            <td>{{ $jquin->peserta->nama_lengkap }}</td>
                            <td>
                                <a href="{{ route('admin.showPeru', $jquin->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail Perusahaan {{ $jquin->nama_perusahaan }}"><i class="ti-eye"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{$jquin->nama_perusahaan}}')" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"><b><i>Tidak Ada Data</i></b></td>
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
            window.location = "{{ url('admin/hapus/perusahaan/destroy') }}" + '/' + id;

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop