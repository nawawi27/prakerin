<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\Perusahaan;
use DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $neko = DB::table('rating')
                ->join('perusahaan','perusahaan.id','=','rating.perusahaan_id')
                ->select('perusahaan.id','perusahaan.nama_perusahaan', 'perusahaan.bidang_usaha', DB::raw('COUNT(*) as total'))
                ->groupBy('perusahaan_id')
                ->get();

            return view('admin.rating.index', compact('neko'));
        }

        $rating = Rating::where('peserta_id', auth()->user()->peserta->id)->get();
        $jquin = Perusahaan::where('id', auth()->user()->peserta->perusahaan_id)->first();

        return view('peserta.rating.index', compact('jquin','rating'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rating::create($request->all());

        return redirect()->back()->with('rating','');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        $neko = Rating::where('perusahaan_id', $perusahaan->id)->get();

        return view('admin.rating.show', compact('neko','perusahaan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $rating = Rating::where('perusahaan_id', $perusahaan->id)->delete();

        return redirect()->back()->with('ratingDestroy','');
    }
}
