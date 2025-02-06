<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Logistik;
use Carbon\Carbon;
use Illuminate\Http\Request;

// class HomeController extends Controller
// {
//     public function index() {
//         $currentUser  = Auth::user();
//         $todos = Todo::all();
//         $jumlahPasien = Pasien::count();
//         $bulanIni = Carbon::now()->month;
//         $tahunIni = Carbon::now()->year;

//         $jumlahPasienBulanIni = Pasien::whereMonth('created_at', $bulanIni)
//                             ->whereYear('created_at', $tahunIni)
//                             ->count();

//         // untuk menampilkan jumlah antrian
//         $antrian = RekamMedis::where('pemeriksaan', 'belum diperiksa')->count();

//         //untuk chart bmhp
//         $bmhp = Logistik::all(['nama', 'jumlah']);


//         // Mendapatkan rentang tanggal untuk bulan ini
//         $endDateBulanSekarang = Carbon::now()->endOfMonth(); // Akhir bulan ini
//         $startDateBulanSekarang = Carbon::now()->startOfMonth(); // Awal bulan ini
//         $jumlahRmBulanSekarang = RekamMedis::whereBetween('tanggal', [$startDateBulanSekarang, $endDateBulanSekarang])->count();

//         // Mendapatkan rentang tanggal untuk bulan lalu
//         $endDateBulanMinSatu = Carbon::now()->subMonth()->endOfMonth(); // Akhir bulan lalu
//         $startDateBulanMinSatu = Carbon::now()->subMonth()->startOfMonth(); // Awal bulan lalu
//         $jumlahRmBulanMinSatu = RekamMedis::whereBetween('tanggal', [$startDateBulanMinSatu, $endDateBulanMinSatu])->count();

//         // Mendapatkan rentang tanggal untuk dua bulan lalu
//         $endDateBulanMinDua = Carbon::now()->subMonths(2)->endOfMonth(); // Akhir dua bulan lalu
//         $startDateBulanMinDua = Carbon::now()->subMonths(2)->startOfMonth(); // Awal dua bulan lalu
//         $jumlahRmBulanMinDua = RekamMedis::whereBetween('tanggal', [$startDateBulanMinDua, $endDateBulanMinDua])->count();

//         // Mendapatkan nama bulan
//         $bulanSekarang = Carbon::now()->format('F');
//         $bulanMinSatu = Carbon::now()->subMonth()->format('F');
//         $bulanMinDua = Carbon::now()->subMonths(2)->format('F');

//     // return 'Pasien bulan ini: --'. $bulanSekarang. $jumlahRmBulanSekarang.',Bulan lalu:--'. $bulanMinSatu.$jumlahRmBulanMinSatu. ', Dua Bulan Lalu :--'.$bulanMinDua. $jumlahRmBulanMinDua. 'bulan-buluan : ';


//     // return $jumlahPasienBulanIni;


//     return view('layouts.welcome', compact(
//     'currentUser','antrian','jumlahPasien', 'jumlahPasienBulanIni',
//     'jumlahRmBulanSekarang','jumlahRmBulanMinSatu','jumlahRmBulanMinDua',
//     'bulanSekarang', 'bulanMinSatu', 'bulanMinDua','bmhp','todos'));
//     }
// }

class HomeController extends Controller
{
    public function index() {
        $currentUser = Auth::user();
        $todos = Todo::all();
        $jumlahPasien = $this->getTotalPasien();
        $jumlahPasienBulanIni = $this->getPasienBulanIni();
        $antrian = $this->getAntrianBelumDiperiksa();
        $bmhp = $this->getBmhpData();
        $rekamMedisStats = $this->getRekamMedisStatistics();

        // return $rekamMedisStats;
        return view('layouts.welcome', compact(
            'currentUser', 'antrian', 'jumlahPasien', 'jumlahPasienBulanIni',
            'rekamMedisStats', 'bmhp', 'todos'
        ));
    }

    private function getTotalPasien()
    {
        return Pasien::count();
    }

    private function getPasienBulanIni()
    {
        return Pasien::whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year)
                      ->count();
    }

    private function getAntrianBelumDiperiksa()
    {
        return RekamMedis::where('pemeriksaan', 'belum diperiksa')->count();
    }

    private function getBmhpData()
    {
        return Logistik::all(['nama', 'jumlah']);
    }

    private function getRekamMedisStatistics()
    {
        $bulanIni = Carbon::now();
        $bulanMinSatu = Carbon::now()->subMonth();
        $bulanMinDua = Carbon::now()->subMonths(2);

        return [
            'bulanIni' => $bulanIni->startOfMonth(),
            'bulanSekarang' => $bulanIni->format('F'),
            'bulanMinSatu' => $bulanMinSatu->format('F'),
            'bulanMinDua' => $bulanMinDua->format('F'),
            'jumlahRmBulanSekarang' => RekamMedis::whereBetween('tanggal', [$bulanIni->copy()->startOfMonth(), $bulanIni->copy()->endOfMonth()])->count(),
            'jumlahRmBulanMinSatu' => RekamMedis::whereBetween('tanggal', [$bulanMinSatu->copy()->startOfMonth(), $bulanMinSatu->copy()->endOfMonth()])->count(),
            'jumlahRmBulanMinDua' => RekamMedis::whereBetween('tanggal',  [$bulanMinDua->copy()->startOfMonth(), $bulanMinDua->copy()->endOfMonth()])->count(),


        ];
    }
}
