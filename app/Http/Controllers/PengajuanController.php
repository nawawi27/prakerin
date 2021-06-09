<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Pengajuan;
use App\Perusahaan;
use App\Peserta;
use App\Rekomendasi;
use DB;

class PengajuanController extends Controller
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
        if (auth()->user()->role != 'admin') {
            $terverifikasi = Peserta::where('id', auth()->user()->peserta->id)->where('perusahaan_id', '!=', NULL)->get();
            $peserta = Pengajuan::where('peserta_id', auth()->user()->peserta->id)->get();
            $perusahaan = Perusahaan::latest()->get();

            return view('peserta.pengajuan.index', compact('peserta','perusahaan','terverifikasi'));
        }

        $neko = DB::table('pengajuan')
                ->join('perusahaan','perusahaan.id','=','pengajuan.perusahaan_id')
                ->select('pengajuan.id','pengajuan.perusahaan_id', 'perusahaan.nama_perusahaan', 'perusahaan.tlp_perusahaan', DB::raw('COUNT(*) as total'))
                ->groupBy('perusahaan_id')
                ->get();

        return view('admin.pengajuan.index', compact('neko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Perusahaan $perusahaan)
    {
        return view('peserta.pengajuan.create', compact('perusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileMove = Storage::disk('public')->putFile('pengajuan',$request->file('path'));

        $neko = [
            'perusahaan_id' => $request->perusahaan_id,
            'peserta_id' => auth()->user()->peserta->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'path' => $fileMove,
            'status' => 'Menunggu Persetujuan'
        ];

        Pengajuan::create($neko);

        return redirect()->route('pengajuan.index')->with('pengajuan','');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        return view('peserta.pengajuan.show', compact('perusahaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        return view('peserta.pengajuan.edit', compact('pengajuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        $fileOri = $request->file('path');
       
        if (empty($request->path)) {
            $fileMove = $request->fileOri;
        } else {
            Storage::delete('public/'.$request->fileOri);
            $fileMove = Storage::disk('public')->putFile('pengajuan', $fileOri);
        }

        $neko = [
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'path' => $fileMove
        ];

        $jquin = Pengajuan::findOrFail($pengajuan->id);
        $jquin->update($neko);

        return redirect()->route('pengajuan.index')->with('update','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan $pengajuan)
    {
        Storage::delete('public/'.$pengajuan->path);
        $pengajuan->delete();

        return redirect()->back()->with('destroyPengajuan','');
    }

    // Admin
    public function showPengajuan(Perusahaan $perusahaan)
    {
        $neko = Pengajuan::where('perusahaan_id', $perusahaan->id)->get();

        return view('admin.pengajuan.show', compact('neko'));
    }

    public function terimaPengajuan(Pengajuan $pengajuan)
    {
        // Update Table Peserta
        $neko = [
            'perusahaan_id' => $pengajuan->perusahaan_id,
            'tanggal_mulai' => $pengajuan->tanggal_mulai,
            'tanggal_selesai' => $pengajuan->tanggal_selesai,
        ];

        $jquin = Peserta::findOrFail($pengajuan->peserta_id);
        $jquin->update($neko);

        // Delete from pengajuan
        Storage::delete('public/'.$pengajuan->path);
        $pengajuan->delete();

        return redirect()->back()->with('konfirmasi','');
    }

    // Terima semua pengajuan
    public function terimaSemuaPengajuan(Request $request)
    {
        $Opsi = [];
        $i = 0;
        
        // Update table peserta
        foreach($request->pilih as $jquin){
            $Opsi[$jquin] = [
                $neko = Peserta::findOrFail($jquin),
                $neko->perusahaan_id = $request->perusahaan[$i],
                $neko->tanggal_mulai = $request->tanggal_mulai[$i],
                $neko->tanggal_selesai = $request->tanggal_selesai[$i],
                $neko->update()
            ];

            $i+=1;
        }

        $h = 0;
        // Hapus from pengajuan
        foreach($request->pengajuan_id as $destroy){
            $Opsi[$destroy] = [
                $hapus = Pengajuan::findOrFail($destroy),
                Storage::delete('public/'.$hapus->path[$h]),
                $hapus->delete()
            ];

            $h+=1;
        }

        return redirect()->route('pengajuan.index')->with('konfirmasi','');
    }

    public function destroyPeserta(Pengajuan $pengajuan)
    {
        Storage::delete('public/'.$pengajuan->path);
        $pengajuan->delete();

        return redirect()->back()->with('destroy','');
    }

    // Hapus semua peserta yang mengajukan
    public function destroyPengajuan(Perusahaan $perusahaan)
    {
        $pengajuan = Pengajuan::where('perusahaan_id', $perusahaan->id)->delete();

        return redirect()->back()->with('destroy','');
    }

    // Ajukan Perusahaan Baru
    public function indexPesertaPengajuan()
    {
        $terverifikasi = Peserta::where('id', auth()->user()->peserta->id)->where('perusahaan_id', '!=', NULL)->get();
        $verifikasi = Pengajuan::where('peserta_id', auth()->user()->peserta->id)->get();
        $neko = Rekomendasi::latest()->get();

        return view('peserta.perusahaan.index', compact('neko','verifikasi','terverifikasi'));
    }

    public function createPengajuan()
    {
        return view('peserta.perusahaan.create');
    }

    public function storePengajuan(Request $request)
    {
        // Cek apakah perusahaan sudah ada di table perusahaan
        if (Perusahaan::where('nama_perusahaan', $request->nama_perusahaan)->orWhere('pemilik_perusahaan', $request->pemilik_perusahaan)->orWhere('tlp_perusahaan', $request->tlp_perusahaan)->exists()) {
            // Jika ada maka kembalikan
            return redirect()->back()->with('SudahAda','');
        } else {
            // Cek apakah perusahaan sudah ada di table rekomendasi
            if (Rekomendasi::where('nama_perusahaan', $request->nama_perusahaan)->orWhere('pemilik_perusahaan', $request->pemilik_perusahaan)->orWhere('tlp_perusahaan', $request->tlp_perusahaan)->exists()) {
                // Jika ada kembalikan
                return redirect()->back()->with('SudahAda','');
            } else {
                // Cek apakah peserta telah mengajukan sebelumnya
                if (Rekomendasi::where('peserta_id', '=', auth()->user()->peserta->id)->exists()) {
                    // Jika peserta sudah mengajukan sebelumnya maka kembalikan
                    return redirect()->back()->with('telahMengajuakan','');
                } else {
                    // Insert Into table rekomendasi
                    $Rekomendasi = Rekomendasi::create([
                        'peserta_id' => auth()->user()->peserta->id,
                        'nama_perusahaan' => $request->nama_perusahaan,
                        'pemilik_perusahaan' => $request->pemilik_perusahaan,
                        'bidang_usaha' => $request->bidang_usaha,
                        'tlp_perusahaan' => $request->tlp_perusahaan,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'alamat' => $request->alamat,
                        'kuota' => $request->kuota,
                        'status' => 'Menunggu Persetujuan'
                    ]);
                    
                    return redirect()->route('pes.index')->with('rekomendasi','');
                }
            }
        }
    }

    public function editPengajuan(Rekomendasi $rekomendasi)
    {
        // Validasi
        if ($rekomendasi->peserta_id != auth()->user()->peserta->id) {
            return redirect()->back();
        } else {
            return view('peserta.perusahaan.edit', compact('rekomendasi'));
        }
    }

    public function updatePengajuan(Request $request, Rekomendasi $rekomendasi)
    {
        $Rekomendasi = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'pemilik_perusahaan' => $request->pemilik_perusahaan,
            'bidang_usaha' => $request->bidang_usaha,
            'tlp_perusahaan' => $request->tlp_perusahaan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'kuota' => $request->kuota
        ];
        
        $jquin = Rekomendasi::findOrFail($rekomendasi->id);
        $jquin->update($Rekomendasi);
        return redirect()->route('pes.index')->with('update','');
    }

    public function destroyPengajuanPerusahaan(Rekomendasi $rekomendasi)
    {
        $rekomendasi->delete();

        return redirect()->back()->with('destroyPengajuan','');
    }

    // Show Lokasi Perusahaan
    public function rekomendasi(Rekomendasi $rekomendasi)
    {
        $perusahaan = $rekomendasi;
        
        return view('peserta.pengajuan.show', compact('perusahaan'));   
    }

    // Search
    public function search(Request $request)
    {
        $perusahaan = Perusahaan::where('nama_perusahaan','LIKE','%'.$request->q.'%')->get();
        $terverifikasi = Peserta::where('id', auth()->user()->peserta->id)->where('perusahaan_id', '!=', NULL)->get();
        $peserta = Pengajuan::where('peserta_id', auth()->user()->peserta->id)->get();

        return view('peserta.pengajuan.index', compact('peserta','perusahaan','terverifikasi'));
    }

    public function searchPu(Request $request)
    {
        $terverifikasi = Peserta::where('id', auth()->user()->peserta->id)->where('perusahaan_id', '!=', NULL)->get();
        $verifikasi = Pengajuan::where('peserta_id', auth()->user()->peserta->id)->get();
        $neko = Rekomendasi::where('nama_perusahaan','LIKE','%'.$request->q.'%')->get();

        return view('peserta.perusahaan.index', compact('neko','verifikasi','terverifikasi'));
    }
}
