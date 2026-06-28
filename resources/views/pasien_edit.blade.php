@extends('layouts.sbadmin2')

@section('isinya')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Edit Pasien
                </div>

                <div class="card-body">

                    <form action="{{ url('pasien/'.$pasien->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Kode Pasien</label>
                            <input type="text"
                                class="form-control"
                                name="kode_pasien"
                                value="{{ $pasien->kode_pasien ?? old('kode_pasien') }}">
                            <span class="text-danger">{{ $errors->first('kode_pasien') }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text"
                                class="form-control"
                                name="nama_pasien"
                                value="{{ $pasien->nama_pasien ?? old('nama_pasien') }}"
                                required>
                            <span class="text-danger">{{ $errors->first('nama_pasien') }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" @selected($pasien->jenis_kelamin=='Laki-laki')>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" @selected($pasien->jenis_kelamin=='Perempuan')>
                                    Perempuan
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('jenis_kelamin') }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Menikah" @selected($pasien->status=='Menikah')>
                                    Menikah
                                </option>
                                <option value="Belum Menikah" @selected($pasien->status=='Belum Menikah')>
                                    Belum Menikah
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control"
                                name="alamat"
                                rows="3"
                                required>{{ $pasien->alamat ?? old('alamat') }}</textarea>
                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ url('pasien') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection