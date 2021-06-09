<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grup;

class GrupController extends Controller
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
        $neko = Grup::orderBy('program_keahlian','ASC')->get();

        return view('admin.grup.index', compact('neko'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Grup::create($request->all());

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
        $jquin = [
            'program_keahlian' => $request->program_keahlian,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
            'kelas' => $request->kelas
        ];

        $neko = Grup::findOrFail($id);
        $neko->update($jquin);

        return redirect()->back()->with('update','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grup $grup)
    {
        $grup->delete();

        return redirect()->back()->with('destroy','');
    }
}
