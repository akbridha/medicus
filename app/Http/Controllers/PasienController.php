<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();
        $pasiens = Pasien::orderBy('created_at', 'desc')->paginate(10);
        return view('layouts.pasien.index',compact('pasiens' , 'currentUser' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view("layouts.pasien.insertPasien");



        $maxNBL = Pasien::max('NBL');
        // $maxNBL = '09-99';

        // Pisahkan bagian angka sebelum dan setelah strip
        $parts = explode('-', $maxNBL);
        $prefix = intval($parts[0]);
        $suffix = intval($parts[1]);

        // echo gettype($prefix);
        // echo gettype($suffix);

        // echo " \n";
        // echo ($prefix);
        // echo "-";
        // echo ($suffix);


        // Tambahkan 1 ke angka setelah strip
        // $suffix++;

        // Jika angka setelah strip melebihi 9, reset ke 1 dan tambahkan 1 ke angka sebelum strip
        if ($suffix == 99) {
            $finalSuffix = 0;
            $finalPrefix = $prefix + 1;
        }else{
            $finalSuffix = $suffix+1;
            $finalPrefix = $prefix;
        }

        // return " ini preffix : ". $prefix. ", dan ini suffix: ". $suffix. ", ini prefix + 1 = [". $finalPrefix . "], dan ini suffix + 1 = [". $finalSuffix."]";


        // Format ulang NBL
        $newNBL = sprintf("%02d-%02d", $finalPrefix, $finalSuffix);

        // return $newNBL;

         return view("layouts.pasien.insertPasien", ['newNBL' => $newNBL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)    {


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
            return redirect()->route('pasien.index')->with('key', 'Berhasil Menambah Pasien');
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')->with('key', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function find(Request $request) {
        $kataKunci = $request->input('kata_kunci');

        // Mencari data dengan kata kunci pencarian
        $pasiens = Pasien::where('Nama', 'like', '%' . $kataKunci . '%')->paginate(3);

        return view('layouts.pasien.index',compact('pasiens'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Pasien $pasien)
    public function edit()
    {
        return view('layouts.pasien.editPasien');
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
