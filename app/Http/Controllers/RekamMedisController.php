<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Http\Requests\StoreRekamMedisRequest;
use App\Http\Requests\UpdateRekamMedisRequest;
use App\Models\Anatomi;
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


    // Menampilkan data rekam yang diantrikan [iterasi 3]
    public function antrian()
    {

    $rekamMedises = RekamMedis::where('pemeriksaan', 'belum diperiksa')->with('pasien')->get();
    // $rekamMedises = RekamMedis::whereNull('pemeriksaan')->with('pasien')->get();
    // return $rekamMedises;
        $currentUser = Auth::user();

        return view('layouts.rm.rekamMedisAntrian', compact('rekamMedises', 'currentUser'));

    }
    // tidak digunakan
    public function create(Request $request)
    {
        //

        $currentUser = Auth::user();
        // return $request;
        return view('layouts.rm.insertRekamMedis', compact('request', 'currentUser'));
    }



    // tidak dipakai
    public function store(Request $request)
    {


        try {
            RekamMedis::create([
                'pasien_id' => $request->input('pasien_id'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'berat_badan' => $request->input('berat_badan'),
                'tinggi_badan' => $request->input('tinggi_badan'),
                'keluhan' => $request->input('keluhan'),
                'pemeriksaan' => $request->input('pemeriksaan'),
                'diagnosa' => $request->input('diagnosa'),
            ]);
            return redirect()->route('home')->with('key', 'Berhasil Registrasi Pasien');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('key', $e->getMessage());
        }



    }

    // crc : Meneruskan data ke dalam antrian berobat [iterasi 2]
    public function regis(Request $request)   {
        //   return $request;
     
        try {
            RekamMedis::create([
                'pasien_id' => $request->input('pasien_id'),
                'pemeriksaan' => $request->input('pemeriksaan'),//dari view dikirimkan value 'belum diperiksa'
                'respiratory' => $request->input('Respiratory'),
                'suhu' => $request->input('Suhu'),
                'heart_rate' => $request->input('heart_rate'),
                'berat_badan' => $request->input('berat_badan'),
                'tinggi_badan' => $request->input('tinggi_badan'),
                'tekanan_darah' => $request->input('tekanan_darah_sistolik') . '/' . $request->input('tekanan_darah_diastolik'),
                'keluhan' => $request->input('keluhan'),
            ]);
            return redirect()->route('home')->with('key', 'Berhasil Registrasi Pasien');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('key', $e->getMessage());
        }
    }
    // crc Menyimpan data registrasi berobat [iterasi 2]
    public function daftar(Request $request)
    {


        $currentUser = Auth::user();
        // return $request;
        return view('layouts.rm.daftarBerobat', compact('request', 'currentUser'));

    }

        // Menampilkan Riwayat RM  [Iterasi 3]
    public function showRiwayats( $id)   {

        // menampilkan riwayat berdasarkan ID pasien
        // return "suka blyat";
        $rekamMedises = Pasien::find($id)->rekamMedis;
        $currentUser = Auth::user();

            if ($rekamMedises) {
        // return $rekamMedises;
                return view('layouts.rm.findRekamMedis', compact('rekamMedises', 'currentUser'));
            } else {
                // Handle ketika pasien tidak ditemukan
                // Misalnya, dapat mengembalikan pesan error atau mengarahkan ke halaman lain.
                return "data Tidak ditemukan";
            }
    }


    public function show($id)  {
        $currentUser = Auth::user();
        $rekamMedis = RekamMedis::with('anatomi')->findOrFail($id);
        // $rekamMedis->load('pasien');
        // $anatomis = Anatomi::with('pasien')->get();
            // experiment vital sign

        // return $anatomis;
        // return $rekamMedis;

        return view('layouts.rm.detailRekamMedis', compact('rekamMedis', 'currentUser'));
    }



    //    Menampilkan Keluhan (RPS)  [iterasi 3]
    public function periksa(RekamMedis $rekamMedis, $namaLogistik = null  )    {
        $currentUser = Auth::user();
        $rekamMedis->load('pasien');
        // apabila nama logistik ada
        if ($namaLogistik) {
            //  ubah $namaLogistik menjadi array
            $namaLogistikArray = explode(',', $namaLogistik);
        }
        // return $rekamMedis;



        return view('layouts.rm.periksaRekamMedis', compact('rekamMedis','namaLogistik', 'currentUser'));
    }



    // public function edit(RekamMedis $rekamMedis , Pasien $pasien)
    public function edit(RekamMedis $rekamMedis, $namaLogistik = null)
    {
        $currentUser = Auth::user();
        $rekamMedis->load('pasien');
        if ($namaLogistik) {
            $rekamMedis->BMHP .= ($rekamMedis->BMHP ? ',' : '') . $namaLogistik;
   
        }
        
        // return $rekamMedis->BMHP;

        
        return view('layouts.rm.editRekamMedis', compact('rekamMedis', 'currentUser'));
    }

    //    Menyimpan data rekam medis [iterasi 3].. method ini kembar siam..
    // sebenarnya untuk fungsi update tapi digunakan untuk fungsi periksa RM oleh dokter
    // karena data RM nya dibuat saat registrasi
    // project ini tidak memuat kasus untuk create rekam medis. melainkan registrasi oleh admin
    public function update(Request $request, RekamMedis $rekamMedis, $redirect) {

        // test print passed data
        // return $redirect;
        // return $request;
        $rekamMedis->tanggal = $request->tanggal;
        $rekamMedis->pemeriksaan = $request->pemeriksaan;
        $rekamMedis->diagnosa = $request->diagnosa;
        $rekamMedis->terapi = $request->terapi;
        $rekamMedis->bmhp = $request->bmhp;



        // Lanjutkan dengan mengupdate data lainnya sesuai kebutuhan

        $rekamMedis->save();

        return redirect()->route($redirect)->with('key', 'Data rekam medis berhasil diupdate');
    }


    public function simpan_anatomi(Request $request){

    // return $request;

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'rekam_medis_id' => 'required | numeric',
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'BagianTubuh' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);
         // Simpan data ke database
        $anatomi = new Anatomi();
        $anatomi->x = $validatedData['x'];
        $anatomi->y = $validatedData['y'];
        $anatomi->bagian_tubuh = $validatedData['BagianTubuh'];
        $anatomi->rekam_medis_id = $validatedData['rekam_medis_id'];
        $anatomi->keterangan = $validatedData['keterangan'];
        $anatomi->save();

        // Mengembalikan respon JSON
        return response()->json(['success' => true, 'anatomi' => $anatomi]);
    }




### Untuk mengambil kembali data anatomi setelah berhasil di masukkan .. diambil ulang dari database supaya sudah ada ID nya yg tergenerate

    public function getAnatomiByRekamMedisId($rekam_medis_id)
    {
    // Mengambil data dari tabel Anatomi berdasarkan rekam_medis_id
    $anatomiData = Anatomi::where('rekam_medis_id', $rekam_medis_id)->get();

    // Mengembalikan data dalam format JSON
    return response()->json($anatomiData);
    }

    public function deletePoint($id)
    {
        // Hapus data dari tabel Anatomi berdasarkan ID
        $anatomi = Anatomi::find($id);

        if ($anatomi) {
            $anatomi->delete();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }




    public function destroy(RekamMedis $rekamMedis)
    {
        //
    }
}
