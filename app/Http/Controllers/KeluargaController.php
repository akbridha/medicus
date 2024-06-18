<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Http\Requests\StoreKeluargaRequest;
use App\Http\Requests\UpdateKeluargaRequest;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();
        $pasiens =  null;
        $pilihans = session()->get('sesipilihan', []);
        // return $pilihans;
        return view('layouts.keluarga.index', compact('pilihans','pasiens' , 'currentUser'));
    }

    public function findPasien(Request $request) {
        $currentUser = Auth::user();
        $kataKunci = $request->input('kata_kunci');
        $pilihans = session()->get('sesipilihan', []);
        // return $pilihans;

        // Mencari data dengan kata kunci pencarian
        $pasiens = Pasien::where('Nama', 'like', '%' . $kataKunci . '%')->get();
        // $pasienss = Pasien::where('Nama', 'like', '%' . $kataKunci . '%')->paginate(3);
        // $pasiens =  null;
        // return $pasiens;
        // $try = session()->get('hasilpencarian', []);
        // return $try;
        // session()->put('hasilpencarian', $pasiens);
        // $data = [

        //         'id' => '06',
        //         'NBL' => '00-07',
        //         'Nama' => 'eman',

        // ];
        // $pasiensCollection = collect($data);
        // $pasiens = $pasiensCollection->merge($pasiens->items());
        // $pasiens->push($data);
        // return $pasiens;
        return view('layouts.keluarga.index',compact( 'pilihans','pasiens','currentUser'));
    }

    public function pilihPasienKeluarga( Request $request){

        $pilihans = session()->get('sesipilihan', []);

        $data = [

                'id' => $request->pasien_id,
                'NBL' => $request->NBL,
                'Nama' => $request->Nama,
    ];


        // session()->put('sesipilihan', $pilihans);

        $pilihans[] = $data;
        session()->put('sesipilihan', $pilihans);

        // $pilihans = collect($data);

        // session()->put('sesipilihan', $pilihans->toArray());
        $try = session()->get('sesipilihan', []);
        // return $try;
        return redirect()->route('keluarga.index');
        //content refactor
        // return view('layouts.keluarga.index',compact('pasiens', 'currentUser'));



    }

    public function clearSession() {
        session()->flush();
        return redirect()->route('keluarga.index');
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
    public function store(Request $request)
    {
        $allPasiens = json_decode($request->input('all_pasiens'), true);
            // buat cek
        return $request;
        return $allPasiens;
        // foreach ($allPasiens as $pasienData) {
        //     $pasien = Pasien::find($pasienData['id']);

        //     if (!$pasien) {
        //         $pasien = new Pasien();
        //     }

        //     $pasien->id = $pasienData['id'];
        //     $pasien->NBL = $pasienData['NBL'];
        //     $pasien->Nama = $pasienData['Nama'];

        //     $pasien->save();
        // }

    }

    /**
     * Display the specified resource.
     */
    public function show(Keluarga $keluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keluarga $keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeluargaRequest $request, Keluarga $keluarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keluarga $keluarga)
    {
        //
    }
}
