@extends('layouts.sbadmin2')

@section('isinya')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    Edit Administrasi
                </div>

                <div class="card-body">

                    <form action="{{ url('administrasi/'.$administrasi->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date"
                                   class="form-control"
                                   name="tanggal"
                                   value="{{ $administrasi->tanggal }}">
                        </div>

                        <div class="mb-3">
                            <label>Pasien</label>

                            <select name="pasien_id" class="form-control">

                                @foreach($list_pasien as $id => $nama)

                                    <option value="{{ $id }}"
                                        @selected($administrasi->pasien_id == $id)>
                                        {{ $nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">
                            <label>Dokter</label>

                            <select name="dokter_id" class="form-control">

                                @foreach($list_dokter as $id => $nama)

                                    <option value="{{ $id }}"
                                        @selected($administrasi->dokter_id == $id)>
                                        {{ $nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">
                            <label>Biaya</label>

                            <input type="number"
                                   class="form-control"
                                   name="biaya"
                                   value="{{ $administrasi->biaya }}">
                        </div>

                        <button class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ url('administrasi') }}"
                           class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection