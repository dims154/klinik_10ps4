@extends('layouts.sbadmin2')

@section('isinya')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Dokter</div>

                    <div class="card-body">
                        <form action="{{ url('dokter/'.$dokter->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="kode_dokter" class="form-label">Kode Dokter</label>
                                <input type="text" class="form-control" id="kode_dokter" name="kode_dokter"
                                value="{{ $dokter->kode_dokter ?? old('kode_dokter') }}" >
                                <span class="text-danger">{{ $errors->first('kode_dokter') }}</span>
                            </div>
                            <div class="mb-3">
                                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter"
                                value="{{ $dokter->nama_dokter ?? old('nama_dokter') }}" required>
                                <span class="text-danger">{{ $errors->first('nama_dokter') }}</span>
                            </div>
                            <div class="mb-3">
                                <label for="spesialis" class="form-label">Spesialis</label>
                                <select class="form-select" id="spesialis" name="spesialis" required>
                                    <option value="">Pilih Spesialis</option>
                                    @foreach ($list_sp as $sp)
                                        <option value="{{ $sp }}" @selected($dokter->spesialis == $sp)>{{ $sp }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('spesialis') }}</span>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp"
                                value="{{ $dokter->nomor_hp ?? old('nomor_hp') }}" required>
                                <span class="text-danger">{{ $errors->first('nomor_hp') }}</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection