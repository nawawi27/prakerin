<div id="editProfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('avatar.update') }}" class="form @error('path') is-invalid @enderror" enctype="multipart/form-data">
                @csrf
                @if(auth()->user()->role == 'admin')
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" required="" value="{{ auth()->user()->nama_lengkap }}">
                </div>

                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Pengguna" required="" name="username" id="username" value="{{ auth()->user()->username }}">
                </div>

                <div class="form-group">
                    <label for="path">Avatar</label>
                    <input type="file" class="filestyle" data-input="false" data-buttonname="btn-secondary btn-sm" name="path" id="path" accept="image/*">
                    <input type="hidden" value="{{ auth()->user()->path }}" name="fileOri">
                </div>
                @else
                <div class="form-group">
                    <label for="path">Avatar</label>
                    <input type="file" class="filestyle" data-input="false" data-buttonname="btn-secondary btn-sm" name="path" id="path" required="" accept="image/*">
                    <input type="hidden" value="{{ auth()->user()->path }}" name="fileOri">
                </div>
                @error('path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->