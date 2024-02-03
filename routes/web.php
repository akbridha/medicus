<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Models\RekamMedis;
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


Route::get('/', function () {
    // return view('layouts.main');
    return view('layouts.dashboard');
});
// Route::get('/pasien', [PasienController::class, 'index']);


Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::get('pasien/create', [PasienController::class, 'create'])->name('pasien.create');
Route::post('pasien/store', [PasienController::class, 'store'])->name('pasien.store');
Route::post('pasien/edit', [PasienController::class, 'edit'])->name('pasien.edit');
Route::get('cari', [PasienController::class,'find' ])->name('cari');


Route::get('/rm', [RekamMedisController::class, 'index'])->name('rm.index');
Route::post('/rm/create', [RekamMedisController::class, 'create'])->name('rm.create');
Route::post('/rm/store', [RekamMedisController::class, 'store'])->name('rm.store');
Route::get('/rm/show/{id}', [RekamMedisController::class, 'show'])->name('rm.show');

Route::get('/master', function(){
    return view('layouts.main');
});
