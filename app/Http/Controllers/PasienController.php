<?php

namespace App\Http\Controllers;

use App\Models\Pasiens;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'judul' => 'Data Pasien',
            'pasiens' => Pasiens::orderBy('id', 'desc')->paginate(10),
        ];

        return view('pasien_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pasien' => 'required|unique:pasiens,kode_pasien',
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'alamat' => 'required',
        ]);

        Pasiens::create($request->all());

        return redirect()->route('pasien.index')
            ->with('pesan', 'Data pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('pasien.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'judul' => 'Edit Data Pasien',
            'pasiens' => Pasiens::findOrFail($id),
        ];

        return view('pasien_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_pasien' => 'required|unique:pasiens,kode_pasien,' . $id,
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'alamat' => 'required',
        ]);

        $pasien = Pasiens::findOrFail($id);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')
            ->with('pesan', 'Data pasien berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasiens::findOrFail($id);

        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with('pesan', 'Data pasien berhasil dihapus.');
    }

    /**
     * Laporan Data Pasien
     */
    public function laporan()
    {
        $laporan = Pasiens::orderBy('kode_pasien')->get();

        return view('pasiens_laporan', compact('laporan'));
    }
}