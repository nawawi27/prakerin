<!-- Alert -->
<script>
    @if(Session::has('store'))
        alertify.success("Data Berhasil Ditambahkan");
    @endif

    @if(Session::has('welcome'))
        alertify.success("Selamat Datang Kembali, {{ auth()->user()->nama_lengkap }}!");
    @endif

    @if(auth()->user()->role == 'peserta')
        @if(auth()->user()->peserta->status != 0)
            @if(Session::has('welcomeP'))
                alertify.success("Selamat Datang Kembali, {{ auth()->user()->nama_lengkap }}!");
            @endif
        @else
            @if(Session::has('welcomeP'))
                alertify.success("Selamat Datang, {{ auth()->user()->nama_lengkap }}!");
            @endif
        @endif
    @endif

    @if(Session::has('suksesPw'))
        alertify.success("Kata Sandi Berhasil Diperbarui");
    @endif

    @if(Session::has('errorPw'))
        alertify.error("Kata Sandi Lama Tidak Sesuai!");
    @endif

    @if(Session::has('update'))
        alertify.success("Data Berhasil Diperbarui");
    @endif

    @if(Session::has('destroy'))
        alertify.success("Data Berhasil Dihapus");
    @endif

    @if(Session::has('pengajuan'))
        alertify.success("Data Berhasil Diajukan");
    @endif

    @if(Session::has('rekomendasi'))
        alertify.success("Perusahaan Berhasil Diajukan");
    @endif

    @if(Session::has('telahMengajuakan'))
        alertify.error("Anda Telah Mengajukan Perusahaan!");
    @endif

    @if(Session::has('SudahAda'))
        alertify.error("Perusahaan Yang Anda Ajukan Sudah Terdaftar!");
    @endif

    @if(Session::has('destroyPengajuan'))
        alertify.success("Pengajuan Berhasil Dihapus");
    @endif

    @if(Session::has('konfirmasi'))
        alertify.success("Pengajuan Berhasil Dikonfirmasi");
    @endif

    @if(Session::has('avatar'))
        alertify.success("Avatar Berhasil Diperbarui");
    @endif

    @if(Session::has('profil'))
        alertify.success("Profil Berhasil Diperbarui");
    @endif

    @if(Session::has('upPrakerin'))
        alertify.success("Prakerin Peserta Berhasil Dihapus");
    @endif

    @if(Session::has('import'))
        alertify.success("Import Berhasil");
    @endif

    @if(Session::has('pembimbing'))
        alertify.success("Peserta Berhasil Ditambahkan");
    @endif

    @if(Session::has('destroyPeserta'))
        alertify.success("Peserta Berhasil Dihapus");
    @endif

    @if(Session::has('tambahNilai'))
        alertify.success("Nilai Berhasil Ditambahkan");
    @endif

    @if(Session::has('editNilai'))
        alertify.success("Nilai Berhasil Diperbarui");
    @endif

    @if(Session::has('rating'))
        alertify.success("Terimakasih Telah Memberikan Penilaian");
    @endif

    @if(Session::has('ratingDestroy'))
        alertify.success("Ulasan Berhasil Dihapus");
    @endif
</script>