@extends('layouts.master')

@section('title','Data Pembimbing')

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
                    <a href="#" data-toggle="modal" data-target="#import" class="btn btn-sm btn-success">Import XLS</a>
                    <button data-target="#tampil" data-toggle="modal" class="btn btn-primary btn-sm">Tambah Data</button>
                </div>
                <h4 class="mt-0 header-title">Data Pembimbing</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Lengkap</th>
                            <th>No Telpon</th>
                            <th>Total Peserta</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nama_lengkap }}</td>
                            <td>{{ $jquin->tlp }}</td>
                            <td><a href="{{ route('pembimbing.peserta', $jquin->id) }}" class="text-info" data-toggle="tooltip" data-palcement="top" title="Detail">{{ $jquin->peserta->count() }} Peserta</a></td>
                            <td>
                                <a href="{{ route('pembimbing.tp', $jquin->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-palcement="top" title="Tambah Peserta"><i class="mdi mdi-account-plus"></i></a>
                                <a href="#" data-target="#editPembimbing" data-toggle="modal" data-id="{{ $jquin->id }}" data-uid="{{ $jquin->user->id }}" data-nama="{{ $jquin->nama_lengkap }}" data-username="{{ $jquin->user->username }}" data-tlp="{{ $jquin->tlp }}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->user->id }},{{ $jquin->id }},'{{ $jquin->nama_lengkap }}')" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
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

<!-- Modal -->
<x-pembimbing></x-pembimbing>
<x-editpembimbing></x-editpembimbing>
<!-- Import -->
<x-importPembimbing></x-importPembimbing>
@stop

@section('footer')
<script src="{{asset('admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<script>
$().DataTable();
</script>

<!-- Update Data -->
<x-updatePembimbing></x-updatePembimbing>

<!-- Destroy -->
<script>
    function destroy(id,idP,nama) {
        alertify.confirm("Hapus Pembimbing "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "pembimbing/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop