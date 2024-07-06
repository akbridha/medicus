<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    // crc Mengarahkan ke halaman login[ iterasi 1]
    function index() {
        $currentUser  = Auth::user();
        return view('layouts.sesi.index', compact('currentUser')); }
    //crc login
    function login(Request $request){

        //pengecekan apakah sudah login atau belum [ iterasi 1]
        if(Auth::check()){
            return redirect('/')->withErrors('Anda sudah login');
        //apabila memang belum login baru diproses agar tidak tertimpa.
        }else{
            Session::flash('email', $request->email);
            $request->validate([
                'email'=>'required',
                'password'=>'required'
            ], [
                'email.required'=>'Email wajib diisi',
                'password.required'=>'Password wajib diisi',
            ]);


            $user = User::where('email', $request->email)->first();
            if ($user && $request->password == $user->password) {
                Auth::login($user);
                return redirect('/')->with('key', 'Berhasil');
            } else {
                return redirect('/sesi')->withErrors('Username/Password tidak valid');
            }
        }   }
        // crc logout [ iterasi 1]
        public function logout(){
            $user = Auth::user();
            if($user != null){
                Auth::logout(); // Melakukan logout pengguna
                return redirect('/')->with('key', 'Berhasil Logout dari akun : '.$user->name); // Mengarahkan kembali ke halaman login
            }else{
                return redirect('/sesi')->with('key', 'Belum Login');
            }    }
}
