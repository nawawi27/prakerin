<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;
use App\Peserta;
use App\Pengajuan;
use App\Rekomendasi;
use App\User;
use App\Informasi;
use App\Pembimbing;

class DashboardController extends Controller
{
	// Kunci Layar
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('kunciAkun');
    }

	// Admin
	public function adminDashboard()
	{
		// Count
		$perusahaan = Perusahaan::count();
		$peserta = Peserta::count();
		$pengajuan = Pengajuan::count();
		$rekomendasi = Rekomendasi::count();
		$rekapitulasi = Peserta::where('perusahaan_id', '!=', NULL)->count();
		$pembimbing = Pembimbing::count();

		return view('dashboard.admin', compact('perusahaan','peserta','pengajuan','rekomendasi','rekapitulasi','pembimbing'));
	}

	// Pembimbing
	public function pembimbingDashboard()
	{
		$date = date('Y-m-d');
		$informasi = Informasi::where('tanggal', $date)->latest()->get();
		$jquin = Pembimbing::where('user_id', auth()->user()->id)->first();

		return view('dashboard.pembimbing', compact('informasi','jquin'));
	}

	// Peserta
	public function pesertaDashboard()
	{
		$date = date('Y-m-d');
		$informasi = Informasi::where('tanggal', $date)->latest()->get();
		$peserta = Peserta::where('user_id', auth()->user()->id)->get();

		return view('dashboard.peserta', compact('informasi','peserta'));
	}

	public function biodata(Request $request)
	{
		$id = auth()->user()->peserta->id;
		$neko = [
			'tlp_peserta' => $request->tlp_peserta,
			'tlp_orangtua' => $request->tlp_orangtua,
			'catatan_kesehatan' => $request->catatan_kesehatan,
			'alamat' => $request->alamat,
			'ttl' => $request->ttl,
			'status' => 1
		];

		$jquin = Peserta::findOrFail($id);
		$jquin->update($neko);

		return redirect()->back()->with('update','');
	}
}
