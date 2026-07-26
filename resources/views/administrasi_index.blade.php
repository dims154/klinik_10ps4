@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">{{ $judul }}</h5>

                    <a href="{{ url('administrasi/create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Administrasi
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
                                    <th width="60">ID</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Biaya</th>
                                    <th width="150">Aksi</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($administrasi as $a)

                                    <tr>

                                        <td>{{ $a->id }}</td>

                                        <td>{{ $a->tanggal }}</td>

                                        <td>

                                            {{ $a->pasien->nama_pasien ?? '-' }}

                                        </td>

                                        <td>

                                            {{ $a->dokter->nama_dokter ?? '-' }}

                                        </td>

                                        <td>

                                            Rp {{ number_format($a->biaya,0,',','.') }}

                                        </td>

                                        <td>

                                            <a href="{{ url('administrasi/'.$a->id.'/edit') }}"
                                               class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ url('administrasi/'.$a->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="text-center">

                                            Data Administrasi Belum Ada

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                @if(method_exists($administrasi,'links'))

                <div class="card-footer">

                    {{ $administrasi->links() }}

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection