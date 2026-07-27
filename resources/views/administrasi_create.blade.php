@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Tambah Data Administrasi
                </div>

                <div class="card-body">
                    <form action="{{ url('administrasi') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>

                            <input
                                type="date"
                                class="form-control"
                                name="tanggal"
                                id="tanggal"
                                value="{{ old('tanggal') }}">

                            <span class="text-danger">
                                {{ $errors->first('tanggal') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="pasien_id">Pasien</label>

                            <select
                                class="form-control"
                                name="pasien_id"
                                id="pasien_id">

                                <option value="">-- Pilih Pasien --</option>

                                @foreach ($list_pasiens as $id => $nama)

                                    <option
                                        value="{{ $id }}"
                                        {{ old('pasien_id') == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>

                                @endforeach

                            </select>

                            <span class="text-danger">
                                {{ $errors->first('pasien_id') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="dokter_id">Dokter</label>

                            <select
                                class="form-control"
                                name="dokter_id"
                                id="dokter_id">

                                <option value="">-- Pilih Dokter --</option>

                                @foreach ($list_dokter as $id => $nama)

                                    <option
                                        value="{{ $id }}"
                                        {{ old('dokter_id') == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>

                                @endforeach

                            </select>

                            <span class="text-danger">
                                {{ $errors->first('dokter_id') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya</label>

                            <input
                                type="number"
                                class="form-control"
                                name="biaya"
                                id="biaya"
                                value="{{ old('biaya') }}">

                            <span class="text-danger">
                                {{ $errors->first('biaya') }}
                            </span>
                        </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Simpan
                    </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection