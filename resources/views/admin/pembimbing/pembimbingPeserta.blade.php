@extends('layouts.master')

@section('title','Data Peserta')

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
                <h4 class="mt-0 header-title">Data Peserta <br><small class="text-info">Peserta yang di bimbing oleh - {{ $pembimbing->nama_lengkap }}</small></h4>
                <br>
                <div class="table-responsive">
                    <form action="{{ route('pembimbing.tpUpdate', $pembimbing->id) }}" method="POST">
                    @csrf
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>JK</th>
                            <th>Program Keahlian</th>
                            <th>Kelas</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jquin->nis }}</td>
                            <td>{{ $jquin->nama_lengkap }}</td>
                            <td>
                                @if($jquin->jk == 'L')
                                Laki-Laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td>{{ $jquin->grup->program_keahlian }}</td>
                            <td>{{ $jquin->grup->kelas }}</td>
                            <td>
                                <a href="#" onclick="destroy({{ $jquin->id }},'{{ $jquin->nama_lengkap }}','{{ $pembimbing->nama_lengkap }}')" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7"><b><i>Tidak Ada Data</i></b></td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@stop

@section('footer')
<script src="{{asset('admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>
<!-- Parsley js -->
<script src="{{asset('admin/plugins/parsleyjs/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<script>
    $().DataTable();
</script>

<!-- Destroy -->
<script>
    function destroy(id,nama,pnm) {
        alertify.confirm("Hapus Peserta "+nama+" Dari Bimbingan "+ pnm +"?", function (ev) {
            ev.preventDefault();
            window.location = "{{ url('admin/pembimbing/peserta/destroy') }}" + '/' + id;

        }, function(ev) {
            ev.preventDefault();
            alertify.error("Batal!");
        });
    }
</script>
@stop