<?php

namespace App\Http\Controllers;

use App\Models\Pasiens;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasiens::where('user_id', Auth::id())
            ->orderBy('nama_pasien')
            ->paginate(10);

        return view('pasien_index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pasien'   => 'required|max:10',
            'nama_pasien'   => 'required|max:30',
            'jenis_kelamin' => 'required',
            'status'        => 'required|max:20',
            'alamat'        => 'required|max:100',
        ]);

        Pasiens::create([
            'user_id'        => Auth::id(),
            'kode_pasien'    => $request->kode_pasien,
            'nama_pasien'    => $request->nama_pasien,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'status'         => $request->status,
            'alamat'         => $request->alamat,
        ]);

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $pasien = Pasiens::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pasien_show', compact('pasien'));
    }

    public function edit(string $id)
    {
        $pasien = Pasiens::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pasien_edit', compact('pasien'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_pasien'   => 'required|max:10',
            'nama_pasien'   => 'required|max:30',
            'jenis_kelamin' => 'required',
            'status'        => 'required|max:20',
            'alamat'        => 'required|max:100',
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

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pasien = Pasiens::where('user_id', Auth::id())
            ->findOrFail($id);

        $pasien->delete();

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }

    public function laporan()
    {
        $laporan = Pasiens::where('user_id', Auth::id())
            ->orderBy('nama_pasien')
            ->get();

        $totalPasien = $laporan->count();

        $totalPemeriksaan = Administrasi::where('user_id', Auth::id())->count();

        $totalPendapatan = Administrasi::where('user_id', Auth::id())->sum('biaya');

        return view('pasien_laporan', compact(
            'laporan',
            'totalPasien',
            'totalPemeriksaan',
            'totalPendapatan'
        ));
    }
}