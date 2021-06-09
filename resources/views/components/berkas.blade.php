<div id="tampil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('berkas.store') }}" class="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_berkas">Nama Berkas</label>
                    <input type="text" class="form-control" name="nama_berkas" id="nama_berkas" required="" placeholder="Masukkan Nama Berkas">
                </div>

                <div class="form-group">
                    <label for="path">File</label>
                    <input type="file" class="filestyle" name="path" id="path" required="" data-input="false" data-buttonname="btn-secondary btn-sm">
                    <code class="highlighter-rouge">*Img,Docx,Pdf</code>
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