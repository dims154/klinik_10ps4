@extends('layouts.sbadmin2')
@section('isinya')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Dokter</div>

                    <div class="card-body">
                        <form action="{{ url('dokter') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="kode_dokter" class="form-label">Kode Dokter</label>
                                <input type="text" class="form-control" id="kode_dokter" name="kode_dokter" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
                            </div>
                            <div class="mb-3">
                                <label for="spesialis" class="form-label">Spesialis</label>
                                <select class="form-select" id="spesialis" name="spesialis" required>
                                    <option value="">Pilih Spesialis</option>
                                    @foreach ($list_sp as $sp)
                                        <option value="{{ $sp }}">{{ $sp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection