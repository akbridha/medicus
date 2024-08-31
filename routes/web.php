<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\KeluargaController;
use App\Models\Keluarga;
use App\Models\Logistik;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//   crc card : Mengarahkan User ke dashboard
Route::get('/', function () {
    $currentUser  = Auth::user();
    $jumlahPasien = Pasien::count();
    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

    $jumlahPasienBulanIni = Pasien::whereMonth('created_at', $bulanIni)
                        ->whereYear('created_at', $tahunIni)
                        ->count();

    // untuk menampilkan jumlah antrian
    $antrian = RekamMedis::where('pemeriksaan', 'belum diperiksa')->count();

    //untuk chart bmhp
    $bmhp = Logistik::all(['nama', 'jumlah']);


    // Mendapatkan rentang tanggal untuk bulan ini
    $endDateBulanSekarang = Carbon::now()->endOfMonth(); // Akhir bulan ini
    $startDateBulanSekarang = Carbon::now()->startOfMonth(); // Awal bulan ini
    $jumlahRmBulanSekarang = RekamMedis::whereBetween('tanggal', [$startDateBulanSekarang, $endDateBulanSekarang])->count();

    // Mendapatkan rentang tanggal untuk bulan lalu
    $endDateBulanMinSatu = Carbon::now()->subMonth()->endOfMonth(); // Akhir bulan lalu
    $startDateBulanMinSatu = Carbon::now()->subMonth()->startOfMonth(); // Awal bulan lalu
    $jumlahRmBulanMinSatu = RekamMedis::whereBetween('tanggal', [$startDateBulanMinSatu, $endDateBulanMinSatu])->count();

    // Mendapatkan rentang tanggal untuk dua bulan lalu
    $endDateBulanMinDua = Carbon::now()->subMonths(2)->endOfMonth(); // Akhir dua bulan lalu
    $startDateBulanMinDua = Carbon::now()->subMonths(2)->startOfMonth(); // Awal dua bulan lalu
    $jumlahRmBulanMinDua = RekamMedis::whereBetween('tanggal', [$startDateBulanMinDua, $endDateBulanMinDua])->count();

    // Mendapatkan nama bulan
    $bulanSekarang = Carbon::now()->format('F');
    $bulanMinSatu = Carbon::now()->subMonth()->format('F');
    $bulanMinDua = Carbon::now()->subMonths(2)->format('F');

// return 'Pasien bulan ini: --'. $jumlahRmBulanSekarang.',Bulan lalu:--'.$jumlahRmBulanMinSatu. ', Dua Bulan Lalu :--'. $jumlahRmBulanMinDua. 'bulan-buluan : '. $bulanSekarang. $bulanMinSatu.$bulanMinDua;




return view('layouts.welcome', compact(
'currentUser','antrian','jumlahPasien', 'jumlahPasienBulanIni',
'jumlahRmBulanSekarang','jumlahRmBulanMinSatu','jumlahRmBulanMinDua',
'bulanSekarang', 'bulanMinSatu', 'bulanMinDua','bmhp'));
})->name('home');



Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/sesi', [SessionController::class, 'index'])->name('session.index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('session.login');
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('session.logout');



// Route::get('/pasien', [PasienController::class, 'index']);


//   ############## Pasien
Route::group(
    ['middleware' =>['isAdmin']], function(){
        Route::get('pasien/create', [PasienController::class, 'create'])->name('pasien.create');
        Route::post('pasien/store', [PasienController::class, 'store'])->name('pasien.store');
        Route::post('pasien/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
        Route::get('/hapus', [PasienController::class, 'destroy'])->name('pasien.hapus');
    }
);
        // route menggunakan 2 role. cukup dengan menggunakan auth: di blade
        Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
        Route::get('/pasien/cari', [PasienController::class,'find' ])->name('pasien.cari');


// ######### Keluarga
Route::get('/form_keluarga', [KeluargaController::class, 'index'])->name('keluarga.index');
Route::get('/create_keluarga', [KeluargaController::class, 'create'])->name('keluarga.create');
Route::get('/tambah_cari_keluarga', [KeluargaController::class, 'findPasien'])->name('keluarga.pasien.find');
Route::get('/cari_keluarga_pasien', [KeluargaController::class, 'find'])->name('keluarga.find');
Route::post('/pilih_pasien_keluarga', [KeluargaController::class, 'pilihPasienKeluarga'])->name('keluarga.pasien.pilih');
Route::post('/keluarga/store', [KeluargaController::class, 'store'])->name('keluarga.store');
Route::delete('/keluarga/{keluarga}', [KeluargaController::class, 'destroy'])->name('keluarga.pasien.destroy');
Route::post('/keluarga/clear-session', [KeluargaController::class, 'clearSession'])->name('keluarga.clear-session');


//  #################### Rekam medis
Route::group(
    ['middleware' =>['isDocter']], function(){
        Route::get('/rm', [RekamMedisController::class, 'index'])->name('rm.index');
        Route::get('/rm/show/{id}', [RekamMedisController::class, 'showRiwayats'])->name('rm.showlist');
        Route::get('/rekam-medis/{id}', [RekamMedisController::class, 'show'])->name('rekamMedis.show');
        // Route::get('/rm/edit/{id}', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::get('/rm/antrian', [RekamMedisController::class, 'antrian'])->name('rm.antrian');
        Route::post('/rm/store', [RekamMedisController::class, 'store'])->name('rm.store');
        Route::put('/rm/{rekamMedis}/{redirect}', [RekamMedisController::class, 'update'])->name('rm.update');

        // Route::get('/rm/{rekamMedis}/{pasien}/edit', [RekamMedisController::class, 'edit'])->name('rm.edit');
        // Route::get('/rm/{rekamMedis}/periksa', [RekamMedisController::class, 'periksa'])->name('rm.periksa');
        Route::get('/rm/{rekamMedis}/periksa/{namaLogistik?}', [RekamMedisController::class, 'periksa'])->name('rm.periksa');
        Route::get('/rm/{rekamMedis}/edit/{namaLogistik?}', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::post('/rm/create', [RekamMedisController::class, 'create'])->name('rm.create');
        Route::post('/save-point', [RekamMedisController::class, 'simpan_anatomi'])->name('anatomi.store');
        Route::get('/get-anatomi/{rekam_medis_id}', [RekamMedisController::class, 'getAnatomiByRekamMedisId']);
        Route::delete('/delete-point/{id}', [RekamMedisController::class, 'deletePoint']);


    }
);

Route::post('/rm/regis', [RekamMedisController::class, 'regis'])->name('rm.regis');
Route::post('/rm/daftar', [RekamMedisController::class, 'daftar'])->name('rm.daftar');





// ######## LOGISTIK

Route::get('/logistik', [LogistikController::class,'index'])->name('logistik.index');
Route::get('/logistik_create', [LogistikController::class,'create'])->name('logistik.create');
Route::post('/logistik_store', [LogistikController::class,'store'])->name('logistik.store');
Route::get('/logistik/{logistik}/edit', [LogistikController::class, 'edit'])->name('logistik.edit');
Route::put('/logistik/{logistik}', [LogistikController::class, 'update'])->name('logistik.update');
Route::delete('/logistik/{logistik}', [LogistikController::class, 'destroy'])->name('logistik.destroy');
Route::get('/logistik/{rm_id}/tx', [LogistikController::class,'transaksi'])->name('logistik.tx');
Route::post('/logistik_pilih', [LogistikController::class,'pilihLogistik'])->name('logistik.pilihtambah');
// Route::post('/logistik/{id}/store_transaksi', [LogistikController::class, 'storeTransaksi'])->name('logistik.txupdate');
Route::post('/logistik/store_transaksi', [LogistikController::class, 'storeTransaksi'])->name('logistik.txupdate');
Route::post('/logistik/{rm_id}/clear-session-logistik', function($rm_id){
            session()->flush();
            return redirect()->route('logistik.tx',$rm_id);
            })->name('logistik.clear-session');
// ###########



//   export data [iterasi 3]
Route::get('/export_db', [DatabaseController::class,'eksport']);
Route::get('/cek_path', function(){echo getenv('PATH');});
// Route::get('/add_sql_to_path', function(){echo getenv('PATH');});
