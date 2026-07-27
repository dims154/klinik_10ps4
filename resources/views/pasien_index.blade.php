@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Data Pasien
        </h1>

        <a href="{{ route('pasien.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus"></i> Tambah Pasien
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Daftar Data Pasien
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light">

                        <tr class="text-center">
                            <th width="60">No</th>
                            <th>Kode Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Alamat</th>
                            <th width="180">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pasiens as $pasien)

                            <tr>

                                <td class="text-center">
                                    {{ $loop->iteration + ($pasiens->firstItem() ?? 1) - 1 }}
                                </td>

                                <td>{{ $pasien->kode_pasien }}</td>

                                <td>{{ $pasien->nama_pasien }}</td>

                                <td>{{ $pasien->jenis_kelamin }}</td>

                                <td>{{ $pasien->status }}</td>

                                <td>{{ $pasien->alamat }}</td>

                                <td class="text-center">

                                    <a href="{{ route('pasien.edit', $pasien->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('pasien.destroy', $pasien->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data pasien.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination di sebelah kiri --}}
            <div class="mt-3">
                {{ $pasiens->links() }}
            </div>

        </div>

    </div>

</div>

@endsection