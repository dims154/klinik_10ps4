<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasiens;
use App\Models\Administrasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        $totalDokter = Dokter::where('user_id', $userId)->count();

        $totalPasien = Pasiens::where('user_id', $userId)->count();

        $totalTransaksi = Administrasi::where('user_id', $userId)->count();

        $totalPendapatan = Administrasi::where('user_id', $userId)->sum('biaya');

        $pendapatanBulanan = Administrasi::where('user_id', $userId)
            ->selectRaw('MONTH(tanggal) as bulan, SUM(biaya) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $statusPasien = Pasiens::where('user_id', $userId)
            ->selectRaw('jenis_kelamin, COUNT(*) as jumlah')
            ->groupBy('jenis_kelamin')
            ->get();

        $transaksiTerbaru = Administrasi::with(['pasien', 'dokter'])
            ->where('user_id', $userId)
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('home', compact(
            'totalDokter',
            'totalPasien',
            'totalTransaksi',
            'totalPendapatan',
            'pendapatanBulanan',
            'statusPasien',
            'transaksiTerbaru'
        ));
    }
}