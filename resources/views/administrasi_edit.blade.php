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

                    <form action="{{ url('administrasi/'.$administrasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>

                            <input
                                type="date"
                                name="tanggal"
                                id="tanggal"
                                class="form-control"
                                value="{{ old('tanggal', $administrasi->tanggal) }}">

                            <span class="text-danger">
                                {{ $errors->first('tanggal') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="pasien_id">Pasien</label>

                            <select
                                name="pasien_id"
                                id="pasien_id"
                                class="form-control">

                                @foreach($list_pasiens as $id => $nama)

                                    <option
                                        value="{{ $id }}"
                                        {{ old('pasien_id', $administrasi->pasien_id) == $id ? 'selected' : '' }}>
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
                                name="dokter_id"
                                id="dokter_id"
                                class="form-control">

                                @foreach($list_dokter as $id => $nama)

                                    <option
                                        value="{{ $id }}"
                                        {{ old('dokter_id', $administrasi->dokter_id) == $id ? 'selected' : '' }}>
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
                                name="biaya"
                                id="biaya"
                                class="form-control"
                                value="{{ old('biaya', $administrasi->biaya) }}">

                            <span class="text-danger">
                                {{ $errors->first('biaya') }}
                            </span>
                        </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-warning btn-sm">
                        Update
                    </button>

                    <a href="{{ route('administrasi.index') }}" class="btn btn-secondary btn-sm">
                        Kembali
                    </a>
                </div>

                    </form>

            </div>

        </div>
    </div>
</div>

@endsection