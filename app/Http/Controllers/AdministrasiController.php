<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Pasiens;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['administrasi'] = Administrasi::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        $data['judul'] = 'Data Administrasi';

        return view('administrasi_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_pasiens'] = Pasiens::where('user_id', Auth::id())
            ->selectRaw("id, concat(kode_pasien,' - ',nama_pasien) as tampil")
            ->pluck('tampil', 'id');

        $data['list_dokter'] = Dokter::where('user_id', Auth::id())
            ->selectRaw("id, concat(kode_dokter,' - ',nama_dokter) as tampil")
            ->pluck('tampil', 'id');

        return view('administrasi_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required',
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'biaya'     => 'required|numeric',
        ]);

        Administrasi::create([
            'user_id'   => Auth::id(),
            'tanggal'   => $request->tanggal,
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'biaya'     => $request->biaya,
        ]);

        return redirect()->route('administrasi.index')
            ->with('success', 'Data administrasi berhasil ditambahkan.');
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
        $data['administrasi'] = Administrasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $data['list_pasiens'] = Pasiens::where('user_id', Auth::id())
            ->selectRaw("id, concat(kode_pasien,' - ',nama_pasien) as tampil")
            ->pluck('tampil', 'id');

        $data['list_dokter'] = Dokter::where('user_id', Auth::id())
            ->selectRaw("id, concat(kode_dokter,' - ',nama_dokter) as tampil")
            ->pluck('tampil', 'id');

        return view('administrasi_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal'   => 'required',
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'biaya'     => 'required|numeric',
        ]);

        $administrasi = Administrasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $administrasi->update([
            'tanggal'   => $request->tanggal,
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'biaya'     => $request->biaya,
        ]);

        return redirect()->route('administrasi.index')
            ->with('success', 'Data administrasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $administrasi = Administrasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $administrasi->delete();

        return redirect()->route('administrasi.index')
            ->with('success', 'Data administrasi berhasil dihapus.');
    }

    /**
     * Laporan Administrasi
     */
    public function laporan()
    {
        $laporan = Administrasi::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->orderByDesc('tanggal')
            ->get();

        $totalTransaksi = Administrasi::where('user_id', Auth::id())->count();
        $totalPendapatan = Administrasi::where('user_id', Auth::id())->sum('biaya');
        $rataBiaya = Administrasi::where('user_id', Auth::id())->avg('biaya');

        return view('administrasi_laporan', compact(
            'laporan',
            'totalTransaksi',
            'totalPendapatan',
            'rataBiaya'
        ));
    }
}