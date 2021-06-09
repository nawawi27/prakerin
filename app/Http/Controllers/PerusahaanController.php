<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;
use App\Rekomendasi;

class PerusahaanController extends Controller
{
    // Kunci Layar
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('kunciAkun');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $neko = Perusahaan::orderBy('nama_perusahaan','ASC')->get();

        return view('admin.perusahaan.index', compact('neko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Perusahaan::create($request->all());

        return redirect()->route('perusahaan.index')->with('store','');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.index')->with('update','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();

        return redirect()->back()->with('destroy','');
    }

    // Pengajuan Perusahaan
    public function indexPengajuan()
    {
        $neko = Rekomendasi::latest()->get();

        return view('admin.perusahaan.pengajuan', compact('neko'));
    }

    public function showPengajuan(Rekomendasi $rekomendasi)
    {
        return view('admin.perusahaan.showPengajuan', compact('rekomendasi'));
    }

    public function konfirmasiPengajuan(Rekomendasi $rekomendasi)
    {
        // Insert Into table perusahaan
        $Rekomendasi = Perusahaan::create([
            'nama_perusahaan' => $rekomendasi->nama_perusahaan,
            'pemilik_perusahaan' => $rekomendasi->pemilik_perusahaan,
            'bidang_usaha' => $rekomendasi->bidang_usaha,
            'tlp_perusahaan' => $rekomendasi->tlp_perusahaan,
            'latitude' => $rekomendasi->latitude,
            'longitude' => $rekomendasi->longitude,
            'alamat' => $rekomendasi->alamat,
            'kuota' => $rekomendasi->kuota
        ]);

        // Hapus perusahaan dari table rekomendasi
        $rekomendasi->delete();

        return redirect()->route('admin.peperu')->with('konfirmasi','');
    }

    public function destroyPengajuan(Rekomendasi $rekomendasi)
    {
        $rekomendasi->delete();

        return redirect()->route('admin.peperu')->with('destroyPengajuan','');
    }
}
