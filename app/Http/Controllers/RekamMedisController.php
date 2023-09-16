<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Http\Requests\StoreRekamMedisRequest;
use App\Http\Requests\UpdateRekamMedisRequest;
use App\Models\Pasien;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekamMedises = RekamMedis::all();
        return view('layouts.rekamMedis', compact('rekamMedises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRekamMedisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

            $rekamMedises = Pasien::find($id)->rekamMedis;

            if ($rekamMedises) {
                return view('layouts.findRekamMedis', compact('rekamMedises'));
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
        //
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
