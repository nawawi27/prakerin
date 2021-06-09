@extends('layouts.master')

@section('title','Detail Ulasan')

@section('css')
<!-- DataTables -->
<link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('admin/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Bootstrap rating css -->
<link href="{{asset('admin/plugins/bootstrap-rating/bootstrap-rating.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Detail Ulasan - {{ $perusahaan->nama_perusahaan }}</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Peserta</th>
                            <th>Rating</th>
                            <th>Ulasan</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->peserta->nama_lengkap }}</td>
                            <td>
                                <input type="hidden" class="rating" data-filled="mdi mdi-star font-15 text-primary" data-empty="mdi mdi-star-outline font-15 text-muted" disabled="disabled" value="{{ $jquin->rating }}"/>
                            </td>
                            <td>
                                {{ $jquin->ulasan }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4"><b><i>Tidak Ada Data</i></b></td>
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
<script src="{{asset('admin/plugins/bootstrap-rating/bootstrap-rating.min.js')}}"></script>
<script src="{{asset('admin/pages/rating-init.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>

<script>
    $().DataTable();
</script>
@stop