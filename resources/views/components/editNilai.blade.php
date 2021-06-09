<div id="editNilai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pesertap.tambahNilai') }}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $jquin->id }}">
                <div class="form-group">
                    <label for="nilai_jurnal">Nilai Jurnal</label>
                    <input type="number" maxlength="3" class="form-control" name="nilai_jurnal" id="nilaiJ" required="" placeholder="Masukkan Nilai Jurnal" value="{{ $jquin->nilai_jurnal }}">
                </div>

                <div class="form-group">
                    <label for="nilai_presentasi">Nilai Presentasi</label>
                    <input type="number" maxlength="3" class="form-control" name="nilai_presentasi" id="nilaiP" required="" value="{{ $jquin->nilai_presentasi }}" placeholder="Masukkan Nilai Presentasi">
                </div>

                <input type="hidden" value="1" name="total">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect btn-sm" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm">Simpan</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->