<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Dokter;
use App\Models\Pasiens;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard
     */
    public function index()
    {
        $userId = Auth::id();

        $totalDokter = Dokter::where('user_id', $userId)->count();

        $totalPasien = Pasiens::where('user_id', $userId)->count();

        $totalTransaksi = Administrasi::where('user_id', $userId)->count();

        $totalPendapatan = Administrasi::where('user_id', $userId)->sum('biaya');

        $pendapatanBulanan = Administrasi::where('user_id', $userId)
            ->selectRaw('MONTH(tanggal) AS bulan, SUM(biaya) AS total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $statusPasien = Pasiens::where('user_id', $userId)
            ->selectRaw('jenis_kelamin, COUNT(*) AS jumlah')
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