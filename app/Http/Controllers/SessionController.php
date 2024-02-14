<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index() {
        return view('layouts.sesi.index');
    }

    function login(Request $request)

    {

        Session::flash('email', $request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ], [
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
                    'email'=>$request->email,
                    'password'=>$request->password
        ];



        // ini adalah fungsi apabila di database pake enkripsi
        // if(Auth::attempt($infologin)){
            //     return redirect('/')->with('success', 'berhasil login');
            // }else{

                //     return redirect('/sesi')->withErrors('Username/Password tidak valid');
                // }

        // ini adalah fungsi apabila di database tidak pake enkripsi
        $user = User::where('email', $request->email)->first();

        if ($user && $request->password == $user->password) {
            Auth::login($user);
            return redirect('/sesi')->with('key', 'Berhasil');
        } else {
            // Password tidak cocok atau pengguna tidak ditemukan
            return redirect('/sesi')->withErrors('Username/Password tidak valid');
        }




    }
    public function logout()
    {
        $user = Auth::user();
        // Auth::logout(); // Melakukan logout pengguna
        return redirect('/sesi')->with('key', 'Berhasil Logout sebagai : '.$user->name); // Mengarahkan kembali ke halaman login
    }
}
