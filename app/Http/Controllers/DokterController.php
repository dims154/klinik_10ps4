<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

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
        $data['list_sp']    =[
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
        $dokter->kode_dokter   = $request->kode_dokter;
        $dokter->nama_dokter   = $request->nama_dokter;
        $dokter->spesialis     = $request->spesialis;
        $dokter->nomor_hp       = $request->nomor_hp;
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
        $data['list_sp']    =[
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
            
            'nama_dokter'  => 'required',
            'spesialis'    => 'required',
            'nomor_hp'     => 'required',
        ]);
        $dokter = Dokter::findOrFail($id);
        $dokter->kode_dokter   = $request->kode_dokter;
        $dokter->nama_dokter   = $request->nama_dokter;
        $dokter->spesialis     = $request->spesialis;
        $dokter->nomor_hp      = $request->nomor_hp;
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
    public function laporan()
    {
        $data['dokter'] = Dokter::all();
        $data['judul'] = 'Laporan Data Dokter';
        return view('dokter_laporan', $data);
    }
}
