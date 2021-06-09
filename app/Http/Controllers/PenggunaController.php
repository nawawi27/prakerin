<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;

class PenggunaController extends Controller
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
        $neko = User::orderBy('role','ASC')->get();

        return view('admin.pengguna.index', compact('neko'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $neko = array(
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'admin'
        );

        User::create($neko);

        return redirect()->back()->with('store','');
    }

    public function update(User $user)
    {
        $pw = [
            'password' => bcrypt('rahasia')
        ];

        $user->update($pw);

        return redirect()->back()->with('suksesPw','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete('public/'.$user->path);
        $user->delete();

        return redirect()->back()->with('destroy','');
    }

    // Profil
    public function profil()
    {
        return view('login.profil');
    }
}
