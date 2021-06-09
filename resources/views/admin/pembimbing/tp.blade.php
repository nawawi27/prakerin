@extends('layouts.master')

@section('title','Tambah Peserta')

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
                <h4 class="mt-0 header-title">Tambah Peserta <br><small class="text-info">Peserta akan di bimbing oleh - {{ $pembimbing->nama_lengkap }}</small></h4>
                <br>
                <div class="table-responsive">
                    <form action="{{ route('pembimbing.tpUpdate', $pembimbing->id) }}" method="POST">
                    @csrf
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="10">
                                <input type="checkbox" class="checkAll">
                            </th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>JK</th>
                            <th>Program Keahlian</th>
                            <th>Kelas</th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @forelse($neko as $jquin)
                        <tr>
                            <td>
                                <input type="checkbox" name="pilih[]" class="pilih" value="{{ $jquin->id }}">
                            </td>
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"><b><i>Tidak Ada Data</i></b></td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if(count($neko) > 0)
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary" id="submit" type="submit">Tambahkan Peserta Yang Dipilih</button>
                    </div>
                    @endif
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

<!-- Check -->
<script>
    // Check All
    $('.checkAll').on('change', function(e) {
        e.preventDefault();
        $('.pilih').prop('checked', this.checked);
    });

    // $('.pilih').on('change', function (e) {
    //     e.preventDefault();

    //     if ($('.pilih').prop('checked') == true) {
    //         $('#submit').prop('disabled', false);
    //     }else{
    //         $('#submit').prop('disabled', true);
    //     }
    // })
</script>
@stop