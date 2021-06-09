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
                <h4 class="mt-0 header-title">Data Peserta</h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>JK</th>
                            <th>Kelas</th>
                            <th>Tempat Prakerin</th>
                            <th>Nilai Akhir</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('pesertap.nilai', $jquin->nis) }}" class="text-info" data-toggle="tooltip" data-placement="top" title="Detail Peserta">{{ $jquin->nis }}</a></td>
                            <td>{{ $jquin->nama_lengkap }}</td>
                            <td>
                                @if($jquin->jk == 'L')
                                Laki-Laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td>{{ $jquin->grup->kelas }}</td>
                            <td>{{ $jquin->perusahaan->nama_perusahaan }}</td>
                                {{-- Hitung Nilai Akhir --}}
                                @php
                                $nilaiJ = $jquin->nilai_jurnal;
                                $nilaiP = $jquin->nilai_presentasi;
                                $total = $nilaiJ + $nilaiP;
                                $hasil = $total/2;
                                @endphp
                            <td>{{ $hasil }}</td>
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
@stop