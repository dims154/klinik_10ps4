<?php

namespace App\Http\Controllers;

use App\Models\Pasiens;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PasiensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pasiens'] = Pasiens::where('user_id', Auth::id())->get();

        return view('pasiens_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasiens_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pasien'    => 'required',
            'nama_pasien'    => 'required',
            'jenis_kelamin'  => 'required',
            'status'         => 'required',
            'alamat'         => 'required',
        ]);

        Pasiens::create([
            'user_id'        => Auth::id(),
            'kode_pasien'    => $request->kode_pasien,
            'nama_pasien'    => $request->nama_pasien,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'status'         => $request->status,
            'alamat'         => $request->alamat,
        ]);

        return redirect()->route('pasiens.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
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
        $data['pasien'] = Pasiens::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pasiens_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_pasien'    => 'required',
            'nama_pasien'    => 'required',
            'jenis_kelamin'  => 'required',
            'status'         => 'required',
            'alamat'         => 'required',
        ]);

        $pasien = Pasiens::where('user_id', Auth::id())
            ->findOrFail($id);

        $pasien->update([
            'kode_pasien'    => $request->kode_pasien,
            'nama_pasien'    => $request->nama_pasien,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'status'         => $request->status,
            'alamat'         => $request->alamat,
        ]);

        return redirect()->route('pasiens.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasiens::where('user_id', Auth::id())
            ->findOrFail($id);

        $pasien->delete();

        return redirect()->route('pasiens.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }

    /**
     * Laporan Data Pasien
     */
    public function laporan()
    {
        $laporan = Pasiens::where('user_id', Auth::id())
            ->orderBy('nama_pasien')
            ->get();

        $totalPasien = Pasiens::where('user_id', Auth::id())->count();

        $totalPemeriksaan = Administrasi::where('user_id', Auth::id())->count();

        $totalPendapatan = Administrasi::where('user_id', Auth::id())->sum('biaya');

        return view('pasiens_laporan', compact(
            'laporan',
            'totalPasien',
            'totalPemeriksaan',
            'totalPendapatan'
        ));
    }
}