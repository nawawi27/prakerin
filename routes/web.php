<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', [
	'uses' => 'AuthController@login',
	'as' => 'login'
]);

Route::post('login', [
	'uses' => 'AuthController@postLogin',
	'as' => 'post.login'
]);

Route::get('logout', [
	'uses' => 'AuthController@logout',
	'as' => 'logout'
]);

Route::group(['middleware' => ['auth','checkRole:admin']], function ()
{
	// Admin
	Route::prefix('admin')->group(function() {
		Route::get('dashboard', [
			'uses' => 'DashboardController@adminDashboard',
			'as' => 'admin.dashboard'
		]);

		// Berkas
		Route::get('berkas', [
			'uses' => 'BerkasController@index',
			'as' => 'berkas.index'
		]);

		Route::post('berkas/store', [
			'uses' => 'BerkasController@store',
			'as' => 'berkas.store'
		]);

		Route::post('berkas/update', [
			'uses' => 'BerkasController@update',
			'as' => 'berkas.update'
		]);

		Route::get('berkas/{berkas}/destroy', [
			'uses' => 'BerkasController@destroy',
			'as' => 'berkas.destroy'
		]);

		// Grup
		Route::get('grup', [
			'uses' => 'GrupController@index',
			'as' => 'grup.index'
		]);

		Route::post('grup/store', [
			'uses' => 'GrupController@store',
			'as' => 'grup.store'
		]);

		Route::post('grup/update', [
			'uses' => 'GrupController@update',
			'as' => 'grup.update'
		]);

		Route::get('grup/{grup}/destroy', [
			'uses' => 'GrupController@destroy',
			'as' => 'grup.destroy'
		]);

		// Pembimbing
		Route::get('pembimbing', [
			'uses' => 'PembimbingController@index',
			'as' => 'pembimbing.index'
		]);

		Route::post('pembimbing/store', [
			'uses' => 'PembimbingController@store',
			'as' => 'pembimbing.store'
		]);

		Route::post('pembimbing/update', [
			'uses' => 'PembimbingController@update',
			'as' => 'pembimbing.update'
		]);

		Route::get('pembimbing/{user}/destroy', [
			'uses' => 'PembimbingController@destroy',
			'as' => 'pembimbing.destroy'
		]);

		Route::post('pembimbing/import/excel', [
			'uses' => 'PembimbingController@importExcel',
			'as' => 'pembimbing.import'
		]);

		// Tambah Peserta
		Route::get('pembimbing/{pembimbing}/tambah-peserta', [
			'uses' => 'PembimbingController@tambahPeserta',
			'as' => 'pembimbing.tp'
		]);

		Route::post('pembimbing/{pembimbing}/tambah-peserta', [
			'uses' => 'PembimbingController@tpUpdate',
			'as' => 'pembimbing.tpUpdate'
		]);

		Route::get('pembimbing/{pembimbing}/peserta', [
			'uses' => 'PembimbingController@pembimbingPeserta',
			'as' => 'pembimbing.peserta'
		]);

		Route::get('pembimbing/peserta/destroy/{peserta}', [
			'uses' => 'PembimbingController@pPDestroy',
			'as' => 'pembimbing.pPDestroy'
		]);

		// Perusahaan
		Route::get('perusahaan', [
			'uses' => 'PerusahaanController@index',
			'as' => 'perusahaan.index'
		]);

		Route::get('perusahaan/create', [
			'uses' => 'PerusahaanController@create',
			'as' => 'perusahaan.create'
		]);

		Route::post('perusahaan/store', [
			'uses' => 'PerusahaanController@store',
			'as' => 'perusahaan.store'
		]);

		Route::get('perusahaan/{perusahaan}/edit', [
			'uses' => 'PerusahaanController@edit',
			'as' => 'perusahaan.edit'
		]);

		Route::post('perusahaan/{perusahaan}/update', [
			'uses' => 'PerusahaanController@update',
			'as' => 'perusahaan.update'
		]);

		Route::get('perusahaan/{perusahaan}/destroy', [
			'uses' => 'PerusahaanController@destroy',
			'as' => 'perusahaan.destroy'
		]);

		// Pengajuan Perusahaan
		Route::get('pengajuan/perusahaan', [
			'uses' => 'PerusahaanController@indexPengajuan',
			'as' => 'admin.peperu'
		]);

		Route::get('detail/pengajuan/{rekomendasi}/perusahaan', [
			'uses' => 'PerusahaanController@showPengajuan',
			'as' => 'admin.showPeru'
		]);

		Route::get('konfirmasi/pengajuan/{rekomendasi}/perusahaan', [
			'uses' => 'PerusahaanController@konfirmasiPengajuan',
			'as' => 'admin.konPeru'
		]);

		Route::get('hapus/perusahaan/destroy/{rekomendasi}', [
			'uses' => 'PerusahaanController@destroyPengajuan',
			'as' => 'admin.destroyperu'
		]);

		// Peserta
		Route::get('peserta', [
			'uses' => 'PesertaController@index',
			'as' => 'peserta.index'
		]);

		Route::get('peserta/create', [
			'uses' => 'PesertaController@create',
			'as' => 'peserta.create'
		]);

		Route::post('peserta/store', [
			'uses' => 'PesertaController@store',
			'as' => 'peserta.store'
		]);

		Route::get('peserta/{peserta}/show', [
			'uses' => 'PesertaController@show',
			'as' => 'peserta.show'
		]);

		Route::get('peserta/{peserta}/edit', [
			'uses' => 'PesertaController@edit',
			'as' => 'peserta.edit'
		]);

		Route::post('peserta/{peserta}/update', [
			'uses' => 'PesertaController@update',
			'as' => 'peserta.update'
		]);

		Route::get('peserta/{user}/destroy', [
			'uses' => 'PesertaController@destroy',
			'as' => 'peserta.destroy'
		]);

		Route::post('peserta/import/excel', [
			'uses' => 'PesertaController@importExcel',
			'as' => 'peserta.import'
		]);

		// Pengajuan
		Route::get('pengajuan', [
			'uses' => 'PengajuanController@index',
			'as' => 'admin.pengajuan'
		]);

		Route::get('pengajuan/{perusahaan}/show', [
			'uses' => 'PengajuanController@showPengajuan',
			'as' => 'pengajuan.show'
		]);

		Route::get('pengajuan/{pengajuan}/update', [
			'uses' => 'PengajuanController@terimaPengajuan',
			'as' => 'pengajuan.terimaPengajuan'
		]);

		Route::get('satu/pengajuan/destroy/{pengajuan}', [
			'uses' => 'PengajuanController@destroyPeserta',
			'as' => 'pengajuan.destroyPeserta'
		]);

		// Terima semua pengajuan
		Route::post('pengajuan/update/semua', [
			'uses' => 'PengajuanController@terimaSemuaPengajuan',
			'as' => 'pengajuan.terimaSemuaPengajuan'
		]);

		// Hapus semua yang mengajukan
		Route::get('pengajuan/{perusahaan}/destroy/admin', [
			'uses' => 'PengajuanController@destroyPengajuan',
			'as' => 'pengajuan.destroyPengajuan'
		]);

		// Rekapitulasi Peserta Prakerin
		Route::get('rekapitulasi/peserta-prakerin', [
			'uses' => 'PesertaController@rekapitulasi',
			'as' => 'admin.rekapPeserta'
		]);

		Route::get('prakerin/peserta/update/{peserta}', [
			'uses' => 'PesertaController@updatePrakerin',
			'as' => 'admin.upPrakerin'
		]);

		Route::get('export/excel', [
			'uses' => 'PesertaController@exportExcel',
			'as' => 'admin.exportExcel'
		]);

		// Rekapitulasi Nilai Peserta
		Route::get('rekapitulasi/nilai-peserta', [
			'uses' => 'PesertaController@rekapitulasiNilai',
			'as' => 'peserta.nilai'
		]);

		// Informasi
		Route::get('informasi', [
			'uses' => 'InformasiController@index',
			'as' => 'informasi.index'
		]);

		Route::get('informasi/create', [
			'uses' => 'InformasiController@create',
			'as' => 'informasi.create'
		]);

		Route::post('informasi/store', [
			'uses' => 'InformasiController@store',
			'as' => 'informasi.store'
		]);

		Route::get('informasi/{informasi}/show', [
			'uses' => 'InformasiController@show',
			'as' => 'informasi.show'
		]);

		Route::get('informasi/{informasi}/edit', [
			'uses' => 'InformasiController@edit',
			'as' => 'informasi.edit'
		]);

		Route::post('informasi/{informasi}/update', [
			'uses' => 'InformasiController@update',
			'as' => 'informasi.update'
		]);

		Route::get('informasi/{informasi}/destroy', [
			'uses' => 'InformasiController@destroy',
			'as' => 'informasi.destroy'
		]);

		// Rating
		Route::get('rating', [
			'uses' => 'RatingController@index',
			'as' => 'rating.admin'
		]);
		
		Route::get('rating/{perusahaan}/ulasan', [
			'uses' => 'RatingController@show',
			'as' => 'rating.show'
		]);

		Route::get('rating/{perusahaan}/destroy', [
			'uses' => 'RatingController@destroy',
			'as' => 'rating.destroy'
		]);

		// Pengguna
		Route::get('pengguna', [
			'uses' => 'PenggunaController@index',
			'as' => 'pengguna.index'
		]);

		Route::post('pengguna/store', [
			'uses' => 'PenggunaController@store',
			'as' => 'pengguna.store'
		]);

		Route::get('pengguna/{user}/update', [
			'uses' => 'PenggunaController@update',
			'as' => 'pengguna.update'
		]);

		Route::get('pengguna/{user}/destroy', [
			'uses' => 'PenggunaController@destroy',
			'as' => 'pengguna.destroy'
		]);

		// Kunci Layar
		Route::get('kunci-layar/', [
			'uses' => 'AuthController@kunciLayar',
			'as' => 'kunci.layar'
		]);

		Route::post('buka-layar', [
			'uses' => 'AuthController@bukaLayar',
			'as' => 'buka.layar'
		]);
	});	

	// Profil	
	Route::get('pengguna/profil', [
		'uses' => 'PenggunaController@profil',
		'as' => 'pengguna.profil'
	]);	

});

Route::group(['middleware' => ['auth','checkRole:admin,pembimbing']], function ()
{
	// Pembimbing
	Route::prefix('pembimbing')->group(function () {
		Route::get('dashboard', [
			'uses' => 'DashboardController@pembimbingDashboard',
			'as' => 'pembimbing.dashboard'
		]);

		// Berkas
		Route::get('berkas', [
			'uses' => 'BerkasController@index',
			'as' => 'berkasp.index'
		]);

		// Peserta
		Route::get('peserta', [
			'uses' => 'PesertaController@index',
			'as' => 'pesertap.index'
		]);

		Route::get('peserta/{nis}/nilai', [
			'uses' => 'PesertaController@nilai',
			'as' => 'pesertap.nilai'
		]);

		Route::post('peserta/nilai', [
			'uses' => 'PesertaController@tambahNilai',
			'as' => 'pesertap.tambahNilai'
		]);

		// Perusahaan
		Route::get('perusahaan', [
			'uses' => 'PerusahaanController@index',
			'as' => 'perusahaanp.index'
		]);

		// Informasi
		Route::get('informasi', [
			'uses' => 'InformasiController@index',
			'as' => 'informasip.index'
		]);
	});

	// Download File
	Route::get('download/berkas/{berkas}/file/berkas', [
		'uses' => 'BerkasController@download',
		'as' => 'berkas.download'
	]);
});

Route::group(['middleware' => ['auth','checkRole:admin,pembimbing,peserta']], function ()
{
	// Peserta
	Route::prefix('peserta')->group(function () {
		Route::get('dashboard', [
			'uses' => 'DashboardController@pesertaDashboard',
			'as' => 'peserta.dashboard'
		]);

		// Informasi
		Route::get('informasi', [
			'uses' => 'InformasiController@index',
			'as' => 'peserta.informasi'
		]);

		// Perbarui Biodata
		Route::post('dashboard/update/biodata', [
			'uses' => 'DashboardController@biodata',
			'as' => 'peserta.biodata'
		]);

		// Pengajuan
		Route::get('pengajuan', [
			'uses' => 'PengajuanController@index',
			'as' => 'pengajuan.index'
		]);

		Route::get('pengajuan/{perusahaan}/create', [
			'uses' => 'PengajuanController@create',
			'as' => 'pengajuan.create'
		]);

		Route::post('pengajuan/store', [
			'uses' => 'PengajuanController@store',
			'as' => 'pengajuan.store'
		]);

		Route::get('pengajuan/{pengajuan}/edit', [
			'uses' => 'PengajuanController@edit',
			'as' => 'pengajuan.edit'
		]);

		Route::post('pengajuan/{pengajuan}/update', [
			'uses' => 'PengajuanController@update',
			'as' => 'pengajuan.update'
		]);

		Route::get('pengajuan/{pengajuan}/destroy', [
			'uses' => 'PengajuanController@destroy',
			'as' => 'pengajuan.destroy'
		]);	

		// Ajukan Pengajuan
		Route::get('perusahaan', [
			'uses' => 'PengajuanController@indexPesertaPengajuan',
			'as' => 'pes.index'
		]);

		Route::get('create/pengajuan', [
			'uses' => 'PengajuanController@createPengajuan',
			'as' => 'pes.crpr'
		]);

		Route::post('store/pengajuan', [
			'uses' => 'PengajuanController@storePengajuan',
			'as' => 'pes.stpr'
		]);

		Route::get('edit/{rekomendasi}/pengajuan', [
			'uses' => 'PengajuanController@editPengajuan',
			'as' => 'pes.editpr'
		]);

		Route::post('update/{rekomendasi}/pengajuan', [
			'uses' => 'PengajuanController@updatePengajuan',
			'as' => 'pes.uppr'
		]);

		Route::get('pengajuan/peserta/perusahaan/{rekomendasi}/destroy', [
			'uses' => 'PengajuanController@destroyPengajuanPerusahaan',
			'as' => 'pes.destroypr'
		]);

		// Rating
		Route::get('rating', [
			'uses' => 'RatingController@index',
			'as' => 'rating.peserta'
		]);

		Route::post('rating/store', [
			'uses' => 'RatingController@store',
			'as' => 'rating.store'
		]);

		// Search
		Route::post('informasi/cari', [
			'uses' => 'InformasiController@search',
			'as' => 'informasi.search'
		]);

		Route::post('pengajuan/cari', [
			'uses' => 'PengajuanController@search',
			'as' => 'pengajuan.search'
		]);

		Route::post('perusahaan/cari', [
			'uses' => 'PengajuanController@searchPu',
			'as' => 'perusahaan.search'
		]);
	});

	// Avatar Update
	Route::post('avatar/update', [
		'uses' => 'AuthController@avatarUpdate',
		'as' => 'avatar.update'
	]);	

	// Ganti Password
	Route::get('pengguna/ganti/kata-sandi', [
		'uses' => 'AuthController@gantiPw',
		'as' => 'ganti.pw'
	]);

	Route::post('pengguna/update/kata-sandi', [
		'uses' => 'AuthController@updatePw',
		'as' => 'update.pw'
	]);

	// Lokasi Perusahaan
	Route::get('detail/{perusahaan}/perusahaan', [
		'uses' => 'PengajuanController@show',
		'as' => 'perpes.detail'
	]);

	Route::get('detail/{rekomendasi}/pengajuan/perusahaan', [
		'uses' => 'PengajuanController@rekomendasi',
		'as' => 'perpes.rekomendasi'
	]);

	// Read Artikel
	Route::get('informasi/{informasi}/artikel', [
		'uses' => 'InformasiController@show',
		'as' => 'peserta.infoshow'
	]);

	// Download File
	Route::get('download/informasi/{informasi}/file/informasi', [
		'uses' => 'InformasiController@download',
		'as' => 'informasi.download'
	]);
});