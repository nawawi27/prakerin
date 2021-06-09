<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PembimbingImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Pembimbing;
use App\User;
use App\Peserta;
use DB;

class PembimbingController extends Controller
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
        $neko = Pembimbing::orderBy('nama_lengkap','ASC')->get();

        return view('admin.pembimbing.index', compact('neko'));
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
        $jquin->username = $request->nama_pengguna;
        $jquin->password = bcrypt('rahasia');
        $jquin->role = 'Pembimbing';
        $jquin->path = 'default.png';
        $jquin->save();

        $neko = new Pembimbing;
        $neko->user_id = $jquin->id;
        $neko->nama_lengkap = $request->nama_lengkap;
        $neko->tlp = $request->tlp;
        $neko->save();

        return redirect()->back()->with('store','');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $uid = $request->uid;

        $jquin = [
            'nama_lengkap' => $request->nama_lengkap,
            'tlp' => $request->tlp
        ];

        $user = ['username' => $request->nama_pengguna];

        // User
        $suki = User::findOrFail($uid);
        $suki->update($user);
        // Pembimbing
        $neko = Pembimbing::findOrFail($id);
        $neko->update($jquin);

        return redirect()->back()->with('update','');
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

    // Tambah Peserta
    public function tambahPeserta(Pembimbing $pembimbing)
    {
        $neko = Peserta::orderBy('nis','ASC')->where('perusahaan_id', '!=', NULL)->where('pembimbing_id', '=', NULL)->get();

        return view('admin.pembimbing.tp', compact('neko','pembimbing'));
    }

    public function tpUpdate(Request $request, Pembimbing $pembimbing)
    {
        $Opsi = [];
        $i = 0;
        
        // Update table peserta
        foreach($request->pilih as $jquin){
            $Opsi[$jquin] = [
                $neko = Peserta::findOrFail($jquin),
                $neko->pembimbing_id = $pembimbing->id,
                $neko->update()
            ];

            $i+=1;
        }

        return redirect()->route('pembimbing.index')->with('pembimbing','');
    }

    public function pembimbingPeserta(Pembimbing $pembimbing)
    {
        $neko = Peserta::where('pembimbing_id', $pembimbing->id)->get();

        return view('admin.pembimbing.pembimbingPeserta', compact('neko','pembimbing'));
    }

    public function pPDestroy(Peserta $peserta)
    {
        $neko = ['pembimbing_id' => NULL];
        $ps = Peserta::findOrFail($peserta->id);
        $ps->update($neko);

        return redirect()->back()->with('destroyPeserta','');
    }

    // Import
    public function importExcel(Request $request)
    {
        Excel::import(new PembimbingImport, $request->file('path'));

        return redirect()->back()->with('import','');
    }
}
