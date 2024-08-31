<?php

namespace App\Http\Controllers;

use App\Models\Logistik;
use App\Http\Requests\StoreLogistikRequest;
use App\Http\Requests\UpdateLogistikRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogistikController extends Controller
{
    public function index(){
        $currentUser = Auth::user();

        $logistiks = Logistik::all(); // Ambil semua data logistik dari database
        return view('layouts.logistik.index', compact('logistiks','currentUser'));
    }

    /**
     *Menampilkan halaman input data BMHP ke sistem[iterasi 5]
     */
    public function create(){
        $currentUser = Auth::user();
        return view('layouts.logistik.insertLogistik', compact('currentUser'));
    }

    /**
     * Menyimpan data baru yang dimasukkan[ iterasi 5]
     */
    public function store(StoreLogistikRequest $request) {
        $currentUser = Auth::user();

        // Validasi manual
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kadaluarsa' => 'required|date'
        ]);

        try {
            // Simpan data logistik baru
            Logistik::create([
                'nama' => $request->input('nama'),
                'jenis' => $request->input('jenis'),
                'jumlah' => $request->input('jumlah'),
                'kadaluarsa' => $request->input('kadaluarsa')
            ]);

            return redirect()->route('logistik.index')->with('key', 'Logistik berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangani error saat penyimpanan data
            return redirect()->route('logistik.index')->with('key', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * tidak dipakai
     */
    public function show(Logistik $logistik) {
        $currentUser = Auth::user();
        return view('layouts.logistik.showLogistik', compact('logistiks','currentUser'));
    }

    /**
     * Menampilkan halaman untuk pembaruan BMHP [iterasi 7]
     */
    public function edit($id){
        // isi request hanya id
        // return $id;
        $currentUser = Auth::user();
        $logistik = Logistik::findOrFail($id);
        // return $logistik;
        // Ambil data logistik berdasarkan ID
        return view('layouts.logistik.edit', compact('logistik','currentUser'));
    }



    /**
     *  Menyimpan Perubahan Pada BMHP [iterasi 7]
     */
    public function update(UpdateLogistikRequest $request, Logistik $logistik)
    {
        $currentUser = Auth::user();
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kadaluarsa' => 'required|date',
            'jumlah' => 'required|integer|min:1'
        ]);

        try {
            // $logistik = Logistik::findOrFail($id);
            $logistik->update([
                'nama' => $request->input('nama'),
                'jenis' => $request->input('jenis'),
                'kadaluarsa' => $request->input('kadaluarsa'),
                'jumlah' => $request->input('jumlah')
            ]);

            return redirect()->route('logistik.index')->with('success', 'Logistik berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('logistik.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    /**
     * Menampilkan BMHP [iterasi 5] [iterasi 7]
     */
    public function transaksi($rekamMedis){
        // return $rekamMedis;
        $currentUser = Auth::user();

        $logistiks = Logistik::all(); // Ambil semua data logistik dari database
        $pilihans = session()->get('sesipilihan', []);
        return view('layouts.logistik.txrm', compact('logistiks','pilihans','rekamMedis','currentUser'));
    }


    // Memilih BMHP yang digunakan [iterasi 5]
    public function pilihLogistik(Request $request){
        $pilihans = session()->get('sesipilihan', []);
        $data = [
                'id' => $request->id,
                'nama' => $request->nama,
                'jumlah' => $request->jumlah
        ];
        // Memeriksa apakah item dengan ID yang sama sudah ada dalam sesi
        $exists = false;
        foreach ($pilihans as $pilihan) {
            if ($pilihan['id'] == $data['id']) {
                $exists = true;
                break;
            }
        }
        // Jika item tidak ada, tambahkan ke dalam sesi
        if (!$exists) {
            $pilihans[] = $data;
            session()->put('sesipilihan', $pilihans);
        }
        // $pilihans[] = $data;
        // session()->put('sesipilihan', $pilihans);
        // pengecekan data
        // $try = session()->get('sesipilihan', []);
        // return $request;
        return redirect()->route('logistik.tx', $request->id_rm);
    }

    // Menyimpan perubahan BMHP tiap kali pemeriksaan [iterasi 5]
    public function storeTransaksi(Request $request){
        try {
            // Retrieve the array of logistik data from the request
            $logistikData = $request->bmhpUpdate;
    
            // Iterate over each logistik data item
            foreach ($logistikData as $logistik) {
                $id = $logistik['id'];
                $jumlah = $logistik['jumlah'];
                $namaLogistik[] = $logistik['nama'];
    
                // Find the Logistik item by ID and update its 'jumlah' value
                $logistikItem = Logistik::find($id);
                if ($logistikItem) {
                    $logistikItem->jumlah = $jumlah;
                    $logistikItem->save();
                }
            }
    
            // If everything went well, return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
    
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Menghapus BMHP [iterasi 7]
     */
    public function destroy(Logistik $logistik){
        // return $logistik;
        $logistik->delete();
        return redirect()->route('logistik.index')->with('success', 'Logistik berhasil dihapus.');
    }
}
