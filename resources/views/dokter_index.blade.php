@extends('layouts.sbadmin2')
@section('isinya')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Dokter</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Dokter</th>
                                <th>Nama Dokter</th>
                                <th>Spesialis</th>
                                <th>Nomor HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokter as $a)
                            <tr>
                                <td>{{ $a->id }}</td>
                                <td>{{ $a->kode_dokter }}</td>
                                <td>{{ $a->nama_dokter }}</td>
                                <td>{{ $a->spesialis }}</td>
                                <td>{{ $a->nomor_hp }}</td>
                                <td>
                                    <a href="{{ url('dokter/'.$a->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ url('dokter/'.$a->id) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Apakah di hapus ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            
        </div>
    </div>
</div>
@endsection