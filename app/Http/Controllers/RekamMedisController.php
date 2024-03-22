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
        // $rekamMedises = RekamMedis::all();
    $rekamMedises = RekamMedis::with('pasien')->get();


        $currentUser = Auth::user();
        // return $rekamMedises;

        return view('layouts.rm.rekamMedis', compact('rekamMedises', 'currentUser'));

    }
    public function antrian()
    {

    $rekamMedises = RekamMedis::where('pemeriksaan', 'belum diperiksa')->with('pasien')->get();
    // $rekamMedises = RekamMedis::whereNull('pemeriksaan')->with('pasien')->get();
    // return $rekamMedises;
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
                'pemeriksaan' => $request->input('pemeriksaan'),//dari view dikirimkan value 'belum diperiksa'



                    //rabu 22 maret
                // 'tanggal' => $request->input('tanggal'),
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
    // public function edit(RekamMedis $rekamMedis , Pasien $pasien)
    public function edit(RekamMedis $rekamMedis )
    {
        $currentUser = Auth::user();
        $rekamMedis->load('pasien');
        // return $rekamMedis;
        return view('layouts.rm.editRekamMedis', compact('rekamMedis', 'currentUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RekamMedis $rekamMedis)
    {
    $rekamMedis->tanggal = $request->tanggal;
    $rekamMedis->pemeriksaan = $request->pemeriksaan;
    $rekamMedis->diagnosa = $request->diagnosa;

    // Lanjutkan dengan mengupdate data lainnya sesuai kebutuhan

    $rekamMedis->save();

    return redirect()->route('rm.index')->with('key', 'Data rekam medis berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekamMedis $rekamMedis)
    {
        //
    }
}
