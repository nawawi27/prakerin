@extends('layouts.master')

@section('title','Data Pengguna')

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
                <h4 class="mt-0 header-title">Data Pengguna</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Pengguna</th>
                            <th>Role</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nama_lengkap }}</td>
                            <td>{{ $jquin->username }}</td>
                            <td>{{ ucwords($jquin->role) }}</td>
                            <td>
                                @if($jquin->role != 'admin')
                                <a href="#" onclick="update({{ $jquin->id }},'{{ $jquin->nama_lengkap }}')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reset Password"><i class="dripicons-retweet"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{ $jquin->nama_lengkap }}')" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                @endif
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
<x-pengguna></x-pengguna>
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
    function update(id,nama) {
        alertify.confirm("Reset Password "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "pengguna/"+ id +"/update";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }

    function destroy(id,nama) {
        alertify.confirm("Hapus Pengguna "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "pengguna/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop