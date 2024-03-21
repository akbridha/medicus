<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Http\Requests\StoreRekamMedisRequest;
use App\Http\Requests\UpdateRekamMedisRequest;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekamMedises = RekamMedis::all();
    // $rekamMedises = RekamMedis::whereNull('pemeriksaan')->with('pasien')->get();
        $currentUser = Auth::user();
        return view('layouts.rm.rekamMedis', compact('rekamMedises', 'currentUser'));

    }
    public function antrian()
    {
        // $rekamMedises = RekamMedis::all();
    $rekamMedises = RekamMedis::whereNull('pemeriksaan')->with('pasien')->get();
        $currentUser = Auth::user();
        return view('layouts.rm.rekamMedisAntrian', compact('rekamMedises', 'currentUser'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        $currentUser = Auth::user();
        // return $request;
        return view('layouts.rm.insertRekamMedis', compact('request', 'currentUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            RekamMedis::create([
                'pasien_id' => $request->input('pasien_id'),
                'tanggal' => $request->input('tanggal'),
                'pemeriksaan' => $request->input('pemeriksaan'),
                'diagnosa' => $request->input('diagnosa'),
            ]);
            return redirect()->route('home')->with('key', 'Berhasil Registrasi Pasien');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('key', $e->getMessage());
        }



    }
    public function regis(Request $request)
    {
        try {
            RekamMedis::create([
                'pasien_id' => $request->input('pasien_id'),
                // 'tanggal' => $request->input('tanggal'), biarkan null
                // 'pemeriksaan' => $request->input('pemeriksaan'), biarkan null
                // 'diagnosa' => $request->input('diagnosa'),  biarkan null agar dia tampil di antrian
            ]);
            return redirect()->route('home')->with('key', 'Berhasil Registrasi Pasien');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('key', $e->getMessage());
        }



    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

            $rekamMedises = Pasien::find($id)->rekamMedis;

            if ($rekamMedises) {
                return view('layouts.rm.findRekamMedis', compact('rekamMedises'));
            } else {
                // Handle ketika pasien tidak ditemukan
                // Misalnya, dapat mengembalikan pesan error atau mengarahkan ke halaman lain.
                return "data Tidak ditemukan";
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RekamMedis $rekamMedis)
    {
        $currentUser = Auth::user();
        // return $rekamMedis;

        return view('layouts.rm.insertRekamMedis', compact('request', 'currentUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekamMedisRequest $request, RekamMedis $rekamMedis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekamMedis $rekamMedis)
    {
        //
    }
}
