<div id="tampil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('grup.store') }}" class="form">
                @csrf
                <div class="form-group">
                    <label for="program_keahlian">Program Keahlian</label>
                    <input type="text" class="form-control" name="program_keahlian" id="program_keahlian" required="" placeholder="Masukkan Program Keahlian">
                    <code class="highlighter-rouge">Contoh : Teknik Informatika</code>
                </div>

                <div class="form-group">
                    <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                    <input type="text" class="form-control" name="kompetensi_keahlian" id="kompetensi_keahlian" required="" placeholder="Masukkan Kompetensi Keahlian">
                    <code class="highlighter-rouge">Contoh : Rekayasa Perangkat Lunak</code>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" name="kelas" id="kelas" required="" placeholder="Masukkan Kelas">
                    <code class="highlighter-rouge">Contoh : XII RPL 2</code>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Simpan</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->