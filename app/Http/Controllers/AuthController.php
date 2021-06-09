<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;
use Hash;
use Session;

class AuthController extends Controller
{
    public function login()
    {
    	return view('login.login');
    }

    public function postLogin(Request $request)
    {
        $ingat = $request->ingatSaya ? true : false;

    	if (Auth::attempt($request->only('username','password'), $ingat)) {
            // Admin
            if (Auth()->user()->role == 'admin') {
        		return redirect()->route('admin.dashboard')->with('welcome','');
                // Pembimbing
            } elseif (Auth()->user()->role == 'pembimbing') {
                return redirect()->route('pembimbing.dashboard')->with('welcome','');
                // Peserta
            } else {
                return redirect()->route('peserta.dashboard')->with('welcomeP','');
            }
    	}

    	return redirect()->back()->with('error','');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }

    // Avatar Update
    public function avatarUpdate(Request $request)
    {
        if (empty($request->path)) {
            $fileMove = $request->fileOri;
        } else {
            Storage::delete('public/'.auth()->user()->path);
            $fileMove = Storage::disk('public')->putFile('pengguna', $request->file('path'));
        }

        if (auth()->user()->role != 'admin') {
            // Validasi
            $request->validate([
                'path' => 'required|mimes:jpg,jpeg,png'
            ]);

            $neko = [
                'path' => $fileMove
            ];

            $user = User::findOrFail(auth()->user()->id);
            $user->update($neko);

            return redirect()->back()->with('avatar','');
        }

        // Validasi
        $request->validate([
            'path' => 'mimes:jpg,jpeg,png'
        ]);

        // Admin
        $neko = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'path' => $fileMove
        ];

        $user = User::findOrFail(auth()->user()->id);
        $user->update($neko);

        return redirect()->back()->with('profil','');
    }

    // Kunci Layar
    public function kunciLayar()
    {
        $jquin = Auth::user();

        if (Auth::check()) {
            Session::put('kunci', true);

            return view('login.kunciLayar', compact('jquin'));
        }

        return redirect()->route('login');
    }

    public function bukaLayar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $password = $request->password;

        if (Hash::check($password, auth()->user()->password)) {
            Session::forget('kunci');
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('passwordSalah', '');
        }
    }

    // Ganti Password
    public function gantiPw()
    {
        return view('login.gantiPw');
    }

    public function updatePw(Request $request)
    {
        // Validasi
        $this->validate($request, [
            'sandiLama' => 'required',
            'sandiBaru' => 'required|min:8'
        ]);

        $sandiLama = $request->sandiLama;
        $sandiBaru = $request->sandiBaru;

            if (!Hash::check($sandiLama, Auth::user()->password)) {
                return redirect()->back()->with('errorPw','');
            }else{
                $neko = [
                    'password' => bcrypt($request->sandiBaru)
                ];

                $jquin = User::findOrFail(auth()->user()->id);
                $jquin->update($neko);

                if (auth()->user()->role == 'admin') {
                    return redirect()->route('admin.dashboard')->with('suksesPw','');
                } elseif (auth()->user()->role == 'pembimbing') {
                    return redirect()->route('pembimbing.dashboard')->with('suksesPw','');
                } else {
                    return redirect()->route('peserta.dashboard')->with('suksesPw','');
                }
            }
    }
}
