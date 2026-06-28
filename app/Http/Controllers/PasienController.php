<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $data['pasien'] = Pasien::all();
        return view('pasien_index', $data);
    }

    public function create()
    {
        return view('pasien_create');
    }

    public function store(Request $request)
    {
        $pasien = new Pasien();
        $pasien->kode_pasien = $request->kode_pasien;
        $pasien->nama_pasien = $request->nama_pasien;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->status = $request->status;
        $pasien->alamat = $request->alamat;
        $pasien->save();

        return redirect('pasien');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['pasien'] = Pasien::findOrFail($id);
        return view('pasien_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->kode_pasien = $request->kode_pasien;
        $pasien->nama_pasien = $request->nama_pasien;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->status = $request->status;
        $pasien->alamat = $request->alamat;
        $pasien->save();

        return redirect('pasien');
    }

    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect('pasien');
    }
}