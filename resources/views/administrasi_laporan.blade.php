@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-file-invoice-dollar"></i>
            Laporan Administrasi
        </h1>

        <div>
            <a href="{{ route('administrasi.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <button onclick="window.print()" class="btn btn-success btn-sm">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-1">
                <div class="card-body">
                    <h6 class="font-weight-bold text-primary text-uppercase">
                        Total Transaksi
                    </h6>

                    <h3>{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-1">
                <div class="card-body">
                    <h6 class="font-weight-bold text-success text-uppercase">
                        Total Pendapatan
                    </h6>

                    <h3>Rp {{ number_format($totalPendapatan,0,',','.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-1">
                <div class="card-body">
                    <h6 class="font-weight-bold text-warning text-uppercase">
                        Rata-rata Biaya
                    </h6>

                    <h3>Rp {{ number_format($rataBiaya,0,',','.') }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">
                Data Transaksi Administrasi
            </h6>

            <small class="text-muted">
                Tanggal Cetak :
                {{ date('d F Y') }}
            </small>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light">

                        <tr>
                            <th width="60">No</th>
                            <th>Tanggal</th>
                            <th>Kode Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Kode Dokter</th>
                            <th>Nama Dokter</th>
                            <th class="text-right">Biaya</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($laporan as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>

                            <td>{{ $item->pasien->kode_pasien ?? '-' }}</td>

                            <td>{{ $item->pasien->nama_pasien ?? '-' }}</td>

                            <td>{{ $item->dokter->kode_dokter ?? '-' }}</td>

                            <td>{{ $item->dokter->nama_dokter ?? '-' }}</td>

                            <td class="text-right">
                                Rp {{ number_format($item->biaya,0,',','.') }}
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                Belum ada transaksi administrasi.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                    <tfoot>

                        <tr class="bg-light font-weight-bold">

                            <td colspan="6" class="text-right">
                                TOTAL PENDAPATAN
                            </td>

                            <td class="text-right">
                                Rp {{ number_format($totalPendapatan,0,',','.') }}
                            </td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

        <div class="card-footer">

            <div class="row">

                <div class="col-md-6">

                    <strong>
                        Total Transaksi :
                        {{ $totalTransaksi }}
                    </strong>

                </div>

                <div class="col-md-6 text-center">

                    Jambi, {{ date('d F Y') }}

                    <br><br>

                    Mengetahui,

                    <br>

                    <strong>Kepala Klinik</strong>

                    <br><br><br>

                    _______________________

                </div>

            </div>

        </div>

    </div>

</div>

<style>

.table th{
    text-align:center;
    vertical-align:middle;
}

.table td{
    vertical-align:middle;
}

@media print{

.sidebar,
.topbar,
footer,
.btn{
    display:none!important;
}

.container-fluid{
    margin:0!important;
    padding:0!important;
}

.card{
    border:none!important;
    box-shadow:none!important;
}

}

</style>

@endsection