<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Http\Requests\StoreKeluargaRequest;
use App\Http\Requests\UpdateKeluargaRequest;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();
        $keluargas = Keluarga::with('pasiens:id,Nama')->get(['id', 'nama']);

        // return $keluargas;
        return view('layouts.keluarga.index', compact('currentUser','keluargas'));
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
        return view('layouts.keluarga.create',compact( 'pilihans','pasiens','currentUser'));
    }

    public function find(Request $request){
        $currentUser = Auth::user();
        // Mencari data dengan kata kunci pencarian
        $pasien = Pasien::with('keluargas.pasiens')->findOrFail($request->id);
        // return $pasien;
        if ($pasien) {
            return view('layouts.keluarga.findKeluarga', compact('pasien', 'currentUser'));
        } else {
            return redirect()->route('layouts.keluarga.index')->with('KEY', 'Pasien tidak ditemukan.');
        }
        // return view('layouts.keluarga.index',compact('keluarga'));
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
        return redirect()->route('keluarga.create');
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

        $currentUser = Auth::user();
        $pasiens =  null;
        $pilihans = session()->get('sesipilihan', []);
        // return $pilihans;
        return view('layouts.keluarga.create', compact('pilihans','pasiens' , 'currentUser'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allPasiens = json_decode($request->input('all_pasiens'), true);

        // untuk validasi supaya aman/
    // Validasi request
        $validator = Validator::make(['pasien' => $allPasiens], [
            'pasien' => 'required|array',
            'pasien.*.id' => 'required|exists:pasiens,id',
            'pasien.*.NBL' => 'required|string',
            'pasien.*.Nama' => 'required|string',
        ]);
        if ($validator->fails()) {
            // return response()->json(['errors' => $validator->errors()], 400);
            return redirect()->route('keluarga.index')->with('key', $validator->errors());;
        }

        // buat keluarga baru,, ini akan jadi record baru di tabel keluarga
        try {
            $Keluarga = Keluarga::create([
                'nama' => $request->input('nama_keluarga')

            ]);
            if($hasil = $this->assign_pasien($Keluarga, $allPasiens)){
                $this->clearSession();
                return redirect()->route('keluarga.index')->with('key', 'Berhasil menambahkan pasien ke keluarga');;
            }else{
                return redirect()->route('keluarga.index')->with('key', 'Gagal menambahkan pasien keluarga');;

            }
            // return response()->json(['message' => 'Keluarga dan pasien berhasil ditambahkan']);
        } catch (\Exception $e) {
                return redirect()->route('keluarga.index')->with('key', $e->getMessage());;
        }
    }

    public function assign_pasien(Keluarga $keluarga, array $all_pasien){


        foreach ($all_pasien as $pasienData) {
            $keluarga->pasiens()->attach($pasienData['id']);
        }

        return true;
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
    public function destroy($keluargaId)
    {
        // Temukan keluarga

        $keluarga = Keluarga::findOrFail($keluargaId);

        // Hapus semua relasi pasien dari keluarga
        $keluarga->pasiens()->detach();

        // Hapus data keluarga
        $keluarga->delete();

        return redirect()->route('keluarga.index')->with('key', 'Keluarga dan relasi berhasil dihapus ');
    }
}
