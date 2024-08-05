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
    public function index(){
        $currentUser = Auth::user();
        $pasiens = Pasien::orderBy('created_at', 'desc')->paginate(10);
        return view('layouts.pasien.index',compact('pasiens' , 'currentUser' ));
    }


    /**
     * crc :Mencari Pasien terdaftar [iterasi 1]
     */
    public function find(Request $request) {
        // $currentUser = Auth::user();
        // $kataKunci = $request->input('kata_kunci');

        // // Mencari data dengan kata kunci pencarian
        // $pasiens = Pasien::where('Nama', 'like', '%' . $kataKunci . '%')->paginate(3);

        // return view('layouts.pasien.index',compact('pasiens', 'currentUser'));


        $currentUser = Auth::user();
        $kataKunci = $request->input('kata_kunci');

        // Nyari dari kata kunci pencarian
        $pasiens = Pasien::where('Nama', 'like', '%' . $kataKunci . '%')->paginate(3);
        // Menambahkan kata_kunci ke links pagination
        $pasiens->appends(['kata_kunci' => $kataKunci]);
        return view('layouts.pasien.index', compact('pasiens', 'currentUser'));
    }

    /**
     * CRC : Menampilkan pendaftaran pasien baru [iterasi 1]
     */
    public function create(){
        // return view("layouts.pasien.insertPasien");


        $currentUser = Auth::user();

        if(Pasien::count() < 1){
            $newNBL = "00-01";
        } else{
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
        }

        return view("layouts.pasien.insertPasien", compact('newNBL', 'currentUser'));
    }

   /**
     * CRC : Menyimpan pendaftaran pasien baru [iterasi 1]
     */
    public function store(Request $request)    {

            // return $request;
        try {
            Pasien::create([
                'NIK' => $request->input('nik_pertama') . $request->input('nik_kedua') . $request->input('nik_ketiga') . $request->input('nik_keempat'),
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
     * Menampilkan halaman ubah data Pasien [Iterasi 4]
     */
    public function edit(Request $request){
        $currentUser = Auth::user();

        // return $request;
        return view('layouts.pasien.editPasien', compact('request', 'currentUser'));
    }

    /**
     *  Menyimpan perubahan Pasien [iterasi 4]
     */
    public function update(Request $request, Pasien $pasien)
        {

        $pasien->Nama = $request->Nama;
        $pasien->NIK = $request->nik_pertama . $request->nik_kedua. $request->nik_ketiga . $request->nik_keempat;
        $pasien->NBL = $request->NBL;
        $pasien->Tanggal_lahir = $request->Tanggal_lahir;
        $pasien->Umur = $request->Umur;
        $pasien->Alamat = $request->Alamat;
        $pasien->Nomor_BPJS = $request->Nomor_BPJS;
        $pasien->Jenis_Kelamin = $request->Jenis_Kelamin;
        $pasien->Pekerjaan = $request->Pekerjaan;


        $pasien->save();

        return redirect()->route('pasien.index')->with('key', 'Data Pasien berhasil diupdate');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request){


        // Cari pasien berdasarkan ID
        $pasien = Pasien::find($request->id);
        // return $pasien;
        if ($pasien) {
            // Hapus pasien
            $pasien->delete();
            // Redirect dengan pesan sukses
            return redirect()->route('pasien.index')->with('key', 'Pasien berhasil dihapus.');
        } else {
            // Redirect dengan pesan error jika pasien tidak ditemukan
            return redirect()->route('pasien.index')->with('key', 'Gagal Menghapus.');
        }
    }
}
