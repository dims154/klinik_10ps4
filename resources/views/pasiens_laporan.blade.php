@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

            <h4>Laporan Data Pasien</h4>

            <button onclick="window.print()" class="btn btn-success btn-sm">
                Cetak
            </button>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Kode Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Alamat</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($laporan as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->kode_pasien }}</td>

                            <td>{{ $item->nama_pasien }}</td>

                            <td>{{ $item->jenis_kelamin }}</td>

                            <td>{{ $item->status }}</td>

                            <td>{{ $item->alamat }}</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">
                                Tidak ada data.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection