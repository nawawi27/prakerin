@extends('layouts.master')

@section('title','Data Grup')

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
                    <button data-target="#tampil" data-toggle="modal" class="btn btn-primary btn-sm">Tambah Data</button>
                </div>
                <h4 class="mt-0 header-title">Data Grup</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">ID</th>
                            <th>Program Keahlian</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Kelas</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $jquin->id }}</td>
                            <td>{{ $jquin->program_keahlian }}</td>
                            <td>{{ $jquin->kompetensi_keahlian }}</td>
                            <td>{{ $jquin->kelas }}</td>
                            <td>
                                <a href="#" data-target="#editGrup" data-toggle="modal" data-id="{{ $jquin->id }}" data-program="{{ $jquin->program_keahlian }}" data-kompetensi="{{ $jquin->kompetensi_keahlian }}" data-kelas="{{ $jquin->kelas }}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }})" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
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
<x-grup></x-grup>
<x-editgrup></x-editgrup>
@stop

@section('footer')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form').parsley();
    });
</script>

<script>
$().DataTable();
</script>

<!-- Update Data -->
<x-updategrup></x-updategrup>

<!-- Destroy -->
<script>
    function destroy(id) {
        alertify.confirm("Hapus Grup Dengan Id "+id+"?", function (ev) {
            ev.preventDefault();
            window.location = "grup/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop