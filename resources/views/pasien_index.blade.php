@extends('layouts.sbadmin2')

@section('isinya')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Data Pasien</span>
                    <a href="{{ url('pasien/create') }}" class="btn btn-primary btn-sm">
                        + Tambah Pasien
                    </a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Pasien</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                                <th>Alamat</th>
                                <th width="170">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pasien as $a)
                            <tr>
                                <td>{{ $a->id }}</td>
                                <td>{{ $a->kode_pasien }}</td>
                                <td>{{ $a->nama_pasien }}</td>
                                <td>{{ $a->jenis_kelamin }}</td>
                                <td>{{ $a->status }}</td>
                                <td>{{ $a->alamat }}</td>
                                <td>
                                    <a href="{{ url('pasien/'.$a->id.'/edit') }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ url('pasien/'.$a->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah data akan dihapus?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>

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
</div>
@endsection