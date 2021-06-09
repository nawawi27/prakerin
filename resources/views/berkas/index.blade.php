@extends('layouts.master')

@section('title','Berkas')

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
                @if(auth()->user()->role == 'admin')
                <div class="float-right">
                    <button data-target="#tampil" data-toggle="modal" class="btn btn-primary btn-sm">Tambah Data</button>
                </div>
                @endif
                <h4 class="mt-0 header-title">Berkas</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Berkas</th>
                            <th>Tanggal Buat</th>
                            <th width="20">Download</th>
                            @if(auth()->user()->role == 'admin')
                            <th>Opsi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nama_berkas }}</td>
                            <td>{{ $jquin->created_at->format('d F Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('berkas.download', $jquin->id) }}" class="btn btn-sm btn-pink"><i class="ti-download"></i></a>
                            </td>
                            @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="#" data-target="#editBerkas" data-toggle="modal" data-id="{{ $jquin->id }}" data-nama="{{ $jquin->nama_berkas }}" data-path="{{ $jquin->path }}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{ $jquin->nama_berkas }}')" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                            </td>
                            @endif
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

@if(auth()->user()->role == 'admin')
<!-- Modal -->
<x-berkas></x-berkas>
<x-editberkas></x-editberkas>
@endif
@stop

@section('footer')
<script src="{{asset('admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>
@if(auth()->user()->role == 'admin')
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form').parsley();
    });
</script>
@endif
<script>
$().DataTable();
</script>

@if(auth()->user()->role == 'admin')
<!-- Update Data -->
<x-updateberkas></x-updateberkas>

<!-- Destroy -->
<script>
    function destroy(id,nama) {
        alertify.confirm("Hapus File "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "berkas/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@endif
@stop