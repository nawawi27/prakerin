<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Informasi;

class InformasiController extends Controller
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
        if (auth()->user()->role == 'admin') {
            $neko = Informasi::latest()->get();

            return view('admin.informasi.index', compact('neko'));
        } elseif (auth()->user()->role == 'pembimbing') {
            $neko = Informasi::latest()->get();

            return view('pembimbing.informasi.index', compact('neko'));
        } else {
            $neko = Informasi::latest()->get();

            return view('peserta.informasi.index', compact('neko'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->path != NULL) {
            $fileMove = Storage::disk('public')->putFile('informasi',$request->file('path'));
        } else {
            $fileMove = NULL;
        }

        $neko = [
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'artikel' => $request->artikel,
            'path' => $fileMove,
            'tanggal' => date('Y-m-d')
        ];

        Informasi::create($neko);

        return redirect()->route('informasi.index')->with('store','');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Informasi $informasi)
    {
        return view('admin.informasi.show', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasi $informasi)
    {
        return view('admin.informasi.edit', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informasi $informasi)
    {
        $fileOri = $request->file('path');
       
        if (empty($request->path)) {
            $fileMove = $request->fileOri;
        } else {
            Storage::delete('public/'.$request->fileOri);
            $fileMove = Storage::disk('public')->putFile('informasi', $fileOri);
        }

        $neko = [
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'artikel' => $request->artikel,
            'path' => $fileMove
        ];

        $jquin = Informasi::findOrFail($informasi->id);
        $jquin->update($neko);

        return redirect()->route('informasi.index')->with('update','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasi $informasi)
    {
        if ($informasi->path != NULL) {
            Storage::delete('public/'.$informasi->path);
        }

        $informasi->delete();

        return redirect()->back()->with('destroy','');
    }

    // Download
    public function download(Informasi $informasi)
    {
        return response()->download(storage_path('app/public/'.$informasi->path));
    }

    // Search
    public function search(Request $request)
    {
        $neko = Informasi::where('judul','LIKE','%'.$request->q.'%')->get();

        return view('peserta.informasi.index', compact('neko'));
    }
}
