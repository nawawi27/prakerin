<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PesertaExport;
use App\Imports\PesertaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Peserta;
use App\User;
use App\Grup;

class PesertaController extends Controller
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
        // Pembimbing
        if (auth()->user()->role == 'pembimbing') {
            $pid = auth()->user()->pembimbing->id;
            $neko = Peserta::orderBy('nis','ASC')->where('pembimbing_id', $pid)->get();

            return view('pembimbing.peserta.index', compact('neko'));
        }

        // Peserta
        $neko = Peserta::orderBy('nis','ASC')->get();

        return view('admin.peserta.index', compact('neko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Grup::orderBy('kelas','ASC')->get();

        return view('admin.peserta.create',compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jquin = new User;
        $jquin->nama_lengkap = $request->nama_lengkap;
        $jquin->username = $request->username;
        $jquin->password = bcrypt('rahasia');
        $jquin->role = 'Peserta';
        $jquin->path = 'default.png';
        $jquin->save();

        $neko = new Peserta;
        $neko->user_id = $jquin->id;
        $neko->grup_id = $request->kelas;
        $neko->nis = $request->nis;
        $neko->nama_lengkap = $request->nama_lengkap;
        $neko->ttl = $request->ttl;
        $neko->jk = $request->jk;
        $neko->tlp_peserta = $request->tlp_peserta;
        $neko->tlp_orangtua = $request->tlp_orangtua;
        $neko->catatan_kesehatan = $request->catatan_kesehatan;
        $neko->alamat = $request->alamat;
        $neko->status = 0;
        $neko->save();

        return redirect()->route('peserta.index')->with('store','');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Peserta $peserta)
    {
        return view('admin.peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Peserta $peserta)
    {
        $kelas = Grup::orderBy('kelas','ASC')->get();

        return view('admin.peserta.edit', compact('peserta','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jquin = [
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'grup_id' => $request->kelas,
            'ttl' => $request->ttl,
            'jk' => $request->jk,
            'tlp_peserta' => $request->tlp_peserta,
            'tlp_orangtua' => $request->tlp_orangtua,
            'catatan_kesehatan' => $request->catatan_kesehatan,
            'alamat' => $request->alamat,
        ];

        $user = ['username' => $request->username];

        // User
        $suki = User::findOrFail($request->uid);
        $suki->update($user);
        // Peserta
        $neko = Peserta::findOrFail($id);
        $neko->update($jquin);

        return redirect()->route('peserta.index')->with('update','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('destroy','');
    }

    // Rekapitulasi
    public function rekapitulasi()
    {
        $neko = Peserta::where('perusahaan_id', '!=', NULL)->orderBy('nama_lengkap','ASC')->get();

        return view('admin.Pengajuan.rekapitulasi', compact('neko'));
    }

    public function updatePrakerin(Peserta $peserta)
    {
        $neko = [
            'perusahaan_id' => NULL,
            'tanggal_mulai' => NULL,
            'tanggal_selesai' => NULL
        ];

        $peserta = Peserta::findOrFail($peserta->id);
        $peserta->update($neko);

        return redirect()->back()->with('upPrakerin','');
    }

    // Export
    public function exportExcel()
    {
        $date = date('d-F-Y');

        return Excel::download(new PesertaExport, 'rekapitulasi-peserta-'.$date.'.xlsx');
    }

    // Import
    public function importExcel(Request $request)
    {
        Excel::import(new PesertaImport, $request->file('path'));

        return redirect()->back()->with('import','');
    }

    // Nilai Peserta
    public function nilai($nis)
    {
        $jquin = Peserta::where('nis', '=', $nis)->first();

        return view('pembimbing.peserta.nilai', compact('jquin'));
    }

    public function tambahNilai(Request $request)
    {
        $neko = [
            'nilai_jurnal' => $request->nilai_jurnal,
            'nilai_presentasi' => $request->nilai_presentasi
        ];

        $jquin = Peserta::findOrFail($request->id);
        $jquin->update($neko);

        if ($request->total != NULL) {
            return redirect()->back()->with('editNilai','');
        }

        return redirect()->back()->with('tambahNilai','');
    }

    // Rekapitulasi Nilai Peserta
    public function rekapitulasiNilai()
    {
        $neko = Peserta::orderBy('nis','ASC')->get();

        return view('admin.peserta.nilai', compact('neko'));
    }
}
