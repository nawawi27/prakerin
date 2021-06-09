@extends('layouts.master')

@section('title','Data Perusahaan')

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
                    <a href="{{ route('perusahaan.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
                </div>
                @endif
                <h4 class="mt-0 header-title">Data Perusahaan</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Perusahaan</th>
                            <th>Pemilik Perusahaan</th>
                            <th>Bidang Usaha</th>
                            <th width="40">No Telpon</th>
                            <th>Kuota</th>
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
                            <td>{{ $jquin->tlp_perusahaan }}</td>
                            <td>{{ $jquin->kuota }} Peserta</td>
                            <td>
                                <a href="#" onclick="tampilDetail({{ $jquin->latitude }}, {{ $jquin->longitude }}, {{ $jquin->id }})" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lokasi Perusahaan"><i class="ti-location-pin"></i></a>
                                @if(auth()->user()->role == 'admin')
                                <a href="{{ route('perusahaan.edit', $jquin->id) }}" class="btn btn-warning btn-sm"><i class="ti-pencil"></i></a>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{$jquin->nama_perusahaan}}')" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7"><b><i>Tidak Ada Data</i></b></td>
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

<!-- Here Maps -->
<script type="text/javascript" src="{{asset('admin/js/here.js')}}"></script>

@if(auth()->user()->role == 'admin')
<!-- Destroy -->
<script>
    function destroy(id,nama) {
        alertify.confirm("Hapus Perusahaan "+nama+"?", function (ev) {
            ev.preventDefault();
            window.location = "perusahaan/"+ id +"/destroy";

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@endif
@stop