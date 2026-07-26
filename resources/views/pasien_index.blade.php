@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

            <h4>Data Pasien</h4>

            <a href="{{ route('pasien.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pasien
            </a>

        </div>

        <div class="card-body">

            @if(session('pesan'))
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light">

                        <tr>
                            <th>No</th>
                            <th>Kode Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Alamat</th>
                            <th width="170">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pasiens as $pasien)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $pasien->kode_pasien }}</td>

                            <td>{{ $pasien->nama_pasien }}</td>

                            <td>{{ $pasien->jenis_kelamin }}</td>

                            <td>{{ $pasien->status }}</td>

                            <td>{{ $pasien->alamat }}</td>

                            <td>

                                <a href="{{ route('pasien.edit',$pasien->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('pasien.destroy',$pasien->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Data belum ada.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{ $pasiens->links() }}

        </div>

    </div>

</div>

@endsection