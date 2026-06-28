<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['administrasi'] = Administrasi::paginate(5);
        $data['judul']        = 'Data Data Administrasi';
        return view('administrasi_index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_pasien'] =
        \App\Models\Pasien::selectRaw("id,concat(kode_pasien,'-',nama_pasien) as tampil")
        ->pluck('tampil','id');

        $data['list_dokter'] =
        \App\Models\Dokter::selectRaw("id,concat(kode_dokter,'-',nama_dokter) as tampil")
        ->pluck('tampil','id');

        return view('administrasi_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required',
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'biaya'     => 'required'
        ]);

        $administrasi       = new Administrasi();
        $administrasi->tanggal      = $request->tanggal;
        $administrasi->pasien_id    = $request->pasien_id;
        $administrasi->dokter_id    = $request->dokter_id;
        $administrasi->biaya        = $request->biaya;
        $administrasi->save();

        return redirect('/administrasi')->with('pesan','Data berhasil ditambah');
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

    $data['list_pasien'] =
    \App\Models\Pasien::selectRaw("id,concat(kode_pasien,'-',nama_pasien) as tampil")
        ->pluck('tampil','id');

    $data['list_dokter'] =
    \App\Models\Dokter::selectRaw("id,concat(kode_dokter,'-',nama_dokter) as tampil")
        ->pluck('tampil','id');

    return view('administrasi_edit',$data);
}

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, string $id)
{
    $request->validate([
        'tanggal'=>'required',
        'pasien_id'=>'required',
        'dokter_id'=>'required',
        'biaya'=>'required'
    ]);

    $administrasi = Administrasi::findOrFail($id);

    $administrasi->tanggal = $request->tanggal;
    $administrasi->pasien_id = $request->pasien_id;
    $administrasi->dokter_id = $request->dokter_id;
    $administrasi->biaya = $request->biaya;

    $administrasi->save();

    return redirect('/administrasi')
        ->with('pesan','Data berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(string $id)
{
    $administrasi = Administrasi::findOrFail($id);

    $administrasi->delete();

    return redirect('/administrasi')
        ->with('pesan','Data berhasil dihapus');
}
}
