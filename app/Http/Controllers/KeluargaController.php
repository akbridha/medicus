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
        try {
            Keluarga::create([
                'nama' => $request->input('nama_keluarga')

            ]);
            $hasil = $this->assign_pasien($allPasiens);
            return response()->json($hasil);
        } catch (\Exception $e) {
            return redirect()->route('keluarga.index')->with('key', $e->getMessage());
        }
    // return $hasil;
    }

    public function assign_pasien(array $all_pasien){

            $keluarga = Keluarga::latest()->first();

            // $allPasiens = json_decode($request->input('all_pasiens'), true);
            // $hasil = ' ';
            // foreach ($allPasiens as $pasienData) {
            // $hasil .= $pasienData['id'] . '<br>';
            // }
            // return redirect()->route('keluarga.index')->with('key', 'Berhasil Menambah Pasien ke Keluarga');
            return $all_pasien;
            // return "suka bliyat";
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
