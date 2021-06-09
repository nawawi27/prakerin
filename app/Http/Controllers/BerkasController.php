<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Berkas;

class BerkasController extends Controller
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
        // Admin
        $neko = Berkas::latest()->get();

        return view('berkas.index', compact('neko'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileMove = Storage::disk('public')->putFile('berkas',$request->file('path'));

        $neko = [
            'nama_berkas' => $request->nama_berkas,
            'path' => $fileMove
        ];

        Berkas::create($neko);

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
        $fileOri = $request->file('path');
       
        if (empty($request->path)) {
            $fileMove = $request->fileOri;
        } else {
            Storage::delete('public/'.$request->fileOri);
            $fileMove = Storage::disk('public')->putFile('berkas', $fileOri);
        }

        $neko = [
            'nama_berkas' => $request->nama_berkas,
            'path' => $fileMove
        ];

        $jquin = Berkas::findOrFail($request->id);
        $jquin->update($neko);

        return redirect()->back()->with('update','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berkas $berkas)
    {
        if ($berkas->path != NULL) {
            Storage::delete('public/'.$berkas->path);
        }

        $berkas->delete();

        return redirect()->back()->with('destroy','');
    }

    // Download
    public function download(Berkas $berkas)
    {
        return response()->download(storage_path('app/public/'.$berkas->path));
    }
}
