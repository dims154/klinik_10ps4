<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dokter'] = Dokter::all();
        return view('dokter_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_sp'] = [
            'Spesialis Anak',
            'Spesialis Bedah',
            'Spesialis Gigi',
        ];

        return view('dokter_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dokter = new Dokter;
        $dokter->kode_dokter = $request->kode_dokter;
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->spesialis = $request->spesialis;
        $dokter->nomor_hp = $request->nomor_hp;
        $dokter->save();

        return redirect('dokter');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dokter'] = Dokter::findOrFail($id);
        $data['list_sp'] = [
            'Spesialis Anak',
            'Spesialis Bedah',
            'Spesialis Gigi',
        ];

        return view('dokter_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis'   => 'required',
            'nomor_hp'    => 'required',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->kode_dokter = $request->kode_dokter;
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->spesialis = $request->spesialis;
        $dokter->nomor_hp = $request->nomor_hp;
        $dokter->save();

        return redirect('dokter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect('dokter');
    }

    /**
     * Laporan Kinerja Dokter
     */
    public function laporan()
    {
        $laporan = Dokter::leftJoin(
                'administrasis',
                'dokters.id',
                '=',
                'administrasis.dokter_id'
            )
            ->select(
                'dokters.id',
                'dokters.kode_dokter',
                'dokters.nama_dokter',
                'dokters.spesialis',
                DB::raw('COUNT(administrasis.id) AS jumlah_pemeriksaan'),
                DB::raw('COALESCE(SUM(administrasis.biaya),0) AS total_pendapatan')
            )
            ->groupBy(
                'dokters.id',
                'dokters.kode_dokter',
                'dokters.nama_dokter',
                'dokters.spesialis'
            )
            ->orderBy('dokters.nama_dokter', 'ASC')
            ->get();

        $totalDokter = Dokter::count();
        $totalPemeriksaan = Administrasi::count();
        $totalPendapatan = Administrasi::sum('biaya');

        return view('dokter_laporan', compact(
            'laporan',
            'totalDokter',
            'totalPemeriksaan',
            'totalPendapatan'
        ));
    }
}