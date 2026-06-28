@extends('layouts.sbadmin2')
@section('isinya')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
     <div class="card-header d-flex justify-content-between align-items-center">
    <span>{{ $judul }}</span>

    <a href="{{ url('administrasi/create') }}"
       class="btn btn-primary btn-sm">
        + Tambah Administrasi
    </a>
</div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($administrasi as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->tanggal }}</td>
<td>{{ $a->pasien->nama_pasien }}</td>
<td>{{ $a->dokter->nama_dokter }}</td>
                                        <td>{{ $a->biaya }}</td>
                                        <td>
    <a href="{{ url('administrasi/'.$a->id.'/edit') }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="{{ url('administrasi/'.$a->id) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Apakah data akan dihapus?')">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger btn-sm">
            Hapus
        </button>

    </form>
</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection