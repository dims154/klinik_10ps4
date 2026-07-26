<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\pasiens;
use App\Models\Dokter;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['administrasi'] = Administrasi::paginate(5);
        $data['judul'] = 'Data Administrasi';

        return view('administrasi_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_pasiens'] = pasiens::selectRaw("
                id,
                concat(kode_pasien,' - ',nama_pasien) as tampil
            ")
            ->pluck('tampil', 'id');

        $data['list_dokter'] = Dokter::selectRaw("
                id,
                concat(kode_dokter,' - ',nama_dokter) as tampil
            ")
            ->pluck('tampil', 'id');

        return view('administrasi_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required',
            'pasien_id' => 'required',
            'dokter_id'  => 'required',
            'biaya'      => 'required|numeric'
        ]);

        Administrasi::create([
            'tanggal'    => $request->tanggal,
            'pasien_id' => $request->pasien_id,
            'dokter_id'  => $request->dokter_id,
            'biaya'      => $request->biaya,
        ]);

        return redirect('/administrasi')
            ->with('pesan', 'Data berhasil ditambah');
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
        $data['administrasi'] = Administrasi::findOrFail($id);

        $data['list_pasiens'] = pasiens::selectRaw("
                id,
                concat(kode_pasien,' - ',nama_pasien) as tampil
            ")
            ->pluck('tampil', 'id');

        $data['list_dokter'] = Dokter::selectRaw("
                id,
                concat(kode_dokter,' - ',nama_dokter) as tampil
            ")
            ->pluck('tampil', 'id');

        return view('administrasi_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal'    => 'required',
            'pasien_id' => 'required',
            'dokter_id'  => 'required',
            'biaya'      => 'required|numeric'
        ]);

        $administrasi = Administrasi::findOrFail($id);

        $administrasi->update([
            'tanggal'    => $request->tanggal,
            'pasien_id' => $request->pasien_id,
            'dokter_id'  => $request->dokter_id,
            'biaya'      => $request->biaya,
        ]);

        return redirect('/administrasi')
            ->with('pesan', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Administrasi::findOrFail($id)->delete();

        return redirect('/administrasi')
            ->with('pesan', 'Data berhasil dihapus');
    }

    /**
     * Laporan Administrasi
     */
    public function laporan()
    {
        $laporan = Administrasi::join(
                'pasiens',
                'administrasis.pasien_id',
                '=',
                'pasiens.id'
            )
            ->join(
                'dokters',
                'administrasis.dokter_id',
                '=',
                'dokters.id'
            )
            ->select(
                'administrasis.tanggal',
                'administrasis.biaya',
                'pasiens.kode_pasien',
                'pasiens.nama_pasien',
                'dokters.kode_dokter',
                'dokters.nama_dokter'
            )
            ->orderBy('administrasis.tanggal', 'DESC')
            ->get();

        $totalTransaksi = Administrasi::count();
        $totalPendapatan = Administrasi::sum('biaya');
        $rataBiaya = Administrasi::avg('biaya');

        return view('administrasi_laporan', compact(
            'laporan',
            'totalTransaksi',
            'totalPendapatan',
            'rataBiaya'
        ));
    }
}