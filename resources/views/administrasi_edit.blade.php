@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Edit Data Administrasi
                </div>

                <div class="card-body">

                    <form action="{{ route('administrasi.update', $administrasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label>Tanggal</label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="{{ old('tanggal', $administrasi->tanggal) }}">

                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Pasien</label>

                            <select
                                name="pasiens_id"
                                class="form-control">

                                <option value="">-- Pilih Pasien --</option>

                                @foreach($list_pasiens as $id => $nama)

                                    <option
                                        value="{{ $id }}"
                                        {{ old('pasiens_id', $administrasi->pasiens_id) == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>

                                @endforeach

                            </select>

                            @error('pasiens_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Dokter</label>

                            <select
                                name="dokter_id"
                                class="form-control">

                                <option value="">-- Pilih Dokter --</option>

                                @foreach($list_dokter as $id => $nama)

                                    <option
                                        value="{{ $id }}"
                                        {{ old('dokter_id', $administrasi->dokter_id) == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>

                                @endforeach

                            </select>

                            @error('dokter_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Biaya</label>

                            <input
                                type="number"
                                name="biaya"
                                class="form-control"
                                value="{{ old('biaya', $administrasi->biaya) }}">

                            @error('biaya')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        Update
                    </button>

                    <a href="{{ route('administrasi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection