<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request ;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = Pasien::all();
        return view('layouts.pasien',compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("layouts.insertPasien");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)    {

        // return $request;
        try {
            Pasien::create([
                'NIK' => $request->input('NIK'),
                'NBL' => $request->input('NBL'),
                'Nama' => $request->input('Nama'),
                'Tanggal_lahir' => $request->input('Tanggal_lahir'),
                'Umur' => $request->input('Umur'),
                'Alamat' => $request->input('Alamat'),
                'Nomor_BPJS' => $request->input('Nomor_BPJS'),
                'Jenis_Kelamin' => $request->input('Jenis_Kelamin'),
                'Pekerjaan' => $request->input('Pekerjaan')?? 'Swasta',
            ]);
            return redirect()->route('pasien.index')->with('key', 'Berhasil');
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')->with('key', $e->getMessage());
        } }

    /**
     * Display the specified resource.
     */
    public function find(Request $request) {
        $kataKunci = $request->input('kata_kunci');

        // Mencari data dengan kata kunci pencarian
        $pasiens = Pasien::where('Nama', 'like', '%' . $kataKunci . '%')->get();

        return view('layouts.pasien',compact('pasiens'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        //
    }
}
