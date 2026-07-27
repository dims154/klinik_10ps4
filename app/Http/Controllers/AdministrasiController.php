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
     * Menampilkan daftar administrasi.
     */
    public function index()
    {
        $data['judul'] = 'Data Administrasi';

        $data['administrasi'] = Administrasi::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('administrasi_index', $data);
    }

    /**
     * Form tambah administrasi.
     */
    public function create()
    {
        $data['list_pasiens'] = Pasiens::where('user_id', Auth::id())
            ->selectRaw("id, CONCAT(kode_pasien,' - ',nama_pasien) AS tampil")
            ->pluck('tampil', 'id');

        $data['list_dokter'] = Dokter::where('user_id', Auth::id())
            ->selectRaw("id, CONCAT(kode_dokter,' - ',nama_dokter) AS tampil")
            ->pluck('tampil', 'id');

        return view('administrasi_create', $data);
    }

    /**
     * Simpan data administrasi.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'pasiens_id' => 'required|exists:pasiens,id',
            'dokter_id'  => 'required|exists:dokters,id',
            'biaya'      => 'required|numeric|min:0',
        ]);

        // Pastikan pasien milik user login
        Pasiens::where('id', $request->pasiens_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Pastikan dokter milik user login
        Dokter::where('id', $request->dokter_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Administrasi::create([
            'user_id'    => Auth::id(),
            'tanggal'    => $request->tanggal,
            'pasiens_id' => $request->pasiens_id,
            'dokter_id'  => $request->dokter_id,
            'biaya'      => $request->biaya,
        ]);

        return redirect()
            ->route('administrasi.index')
            ->with('success', 'Data administrasi berhasil ditambahkan.');
    }

    /**
     * Detail administrasi.
     */
    public function show(string $id)
    {
        $administrasi = Administrasi::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('administrasi_show', compact('administrasi'));
    }

    /**
     * Form edit administrasi.
     */
    public function edit(string $id)
    {
        $data['administrasi'] = Administrasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $data['list_pasiens'] = Pasiens::where('user_id', Auth::id())
            ->selectRaw("id, CONCAT(kode_pasien,' - ',nama_pasien) AS tampil")
            ->pluck('tampil', 'id');

        $data['list_dokter'] = Dokter::where('user_id', Auth::id())
            ->selectRaw("id, CONCAT(kode_dokter,' - ',nama_dokter) AS tampil")
            ->pluck('tampil', 'id');

        return view('administrasi_edit', $data);
    }

    /**
     * Update data administrasi.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'pasiens_id' => 'required|exists:pasiens,id',
            'dokter_id'  => 'required|exists:dokters,id',
            'biaya'      => 'required|numeric|min:0',
        ]);

        Pasiens::where('id', $request->pasiens_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Dokter::where('id', $request->dokter_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $administrasi = Administrasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $administrasi->update([
            'tanggal'    => $request->tanggal,
            'pasiens_id' => $request->pasiens_id,
            'dokter_id'  => $request->dokter_id,
            'biaya'      => $request->biaya,
        ]);

        return redirect()
            ->route('administrasi.index')
            ->with('success', 'Data administrasi berhasil diperbarui.');
    }

    /**
     * Hapus data administrasi.
     */
    public function destroy(string $id)
    {
        $administrasi = Administrasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $administrasi->delete();

        return redirect()
            ->route('administrasi.index')
            ->with('success', 'Data administrasi berhasil dihapus.');
    }

    /**
     * Laporan administrasi.
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