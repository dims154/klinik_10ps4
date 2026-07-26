@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4>Tambah Pasien</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('pasien.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Kode Pasien</label>
                    <input type="text" name="kode_pasien" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="status" class="form-control">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('pasien.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection