@extends('layouts.sbadmin2')

@section('isinya')

<style>

.dashboard-title{
    font-weight:700;
    color:#2e3a59;
}

.dashboard-subtitle{
    color:#858796;
    margin-bottom:30px;
}

.dashboard-card{
    border:none;
    border-radius:18px;
    transition:.3s;
    overflow:hidden;
}

.dashboard-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.card-icon{
    width:65px;
    height:65px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:26px;
}

.bg-doctor{
    background:#4e73df;
}

.bg-patient{
    background:#1cc88a;
}

.bg-transaction{
    background:#f6c23e;
}

.bg-income{
    background:#e74a3b;
}

.dashboard-number{
    font-size:32px;
    font-weight:bold;
    color:#2e3a59;
}

.dashboard-label{
    font-size:13px;
    text-transform:uppercase;
    color:#858796;
    font-weight:bold;
}

.chart-card{
    border:none;
    border-radius:18px;
}

.table-card{
    border:none;
    border-radius:18px;
}

</style>

<div class="container-fluid">

    <div class="d-sm-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="dashboard-title">
                Dashboard Klinik
            </h2>

            <p class="dashboard-subtitle">
                Selamat Datang di Sistem Informasi Klinik UNAMA
            </p>

        </div>

        <span class="badge badge-primary p-3">

            {{ now()->format('d M Y') }}

        </span>

    </div>

    <div class="row">

        <!-- Dokter -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card dashboard-card shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="dashboard-label">
                                Dokter
                            </div>

                            <div class="dashboard-number">

                                {{ $totalDokter }}

                            </div>

                        </div>

                        <div class="card-icon bg-doctor">

                            <i class="fas fa-user-md"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- pasien -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card dashboard-card shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="dashboard-label">
                                pasien
                            </div>

                            <div class="dashboard-number">

                                {{ $totalPasien }}

                            </div>

                        </div>

                        <div class="card-icon bg-patient">

                            <i class="fas fa-users"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Transaksi -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card dashboard-card shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="dashboard-label">
                                Transaksi
                            </div>

                            <div class="dashboard-number">

                                {{ $totalTransaksi }}

                            </div>

                        </div>

                        <div class="card-icon bg-transaction">

                            <i class="fas fa-file-medical"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Pendapatan -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card dashboard-card shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="dashboard-label">
                                Pendapatan
                            </div>

                            <div style="font-size:22px;font-weight:bold;color:#2e3a59">

                                Rp {{ number_format($totalPendapatan,0,',','.') }}

                            </div>

                        </div>

                        <div class="card-icon bg-income">

                            <i class="fas fa-wallet"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Baris Grafik -->

    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card chart-card shadow">

                <div class="card-header bg-white">

                    <strong>Grafik Pendapatan Bulanan</strong>

                </div>

                <div class="card-body">

                    <canvas id="chartPendapatan" height="120"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card chart-card shadow">

                <div class="card-header bg-white">

                    <strong>Jenis Kelamin Pasien</strong>

                </div>

                <div class="card-body">

                    <canvas id="chartStatus"></canvas>

                </div>

            </div>

        </div>

    </div>
        <!-- Transaksi Terbaru & Aktivitas -->

    <div class="row">

        <!-- Transaksi Terbaru -->

        <div class="col-lg-8 mb-4">

            <div class="card table-card shadow">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <strong>Transaksi Terbaru</strong>

                    <span class="badge badge-primary">
                        {{ $transaksiTerbaru->count() }} Data
                    </span>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead class="thead-light">

                            <tr>

                                <th>No</th>
                                <th>Tanggal</th>
                                <th>pasien</th>
                                <th>Dokter</th>
                                <th>Biaya</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($transaksiTerbaru as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                                </td>

                                <td>

                                    {{ $item->Pasien->nama_pasien ?? '-' }}

                                </td>

                                <td>

                                    {{ $item->dokter->nama ?? '-' }}

                                </td>

                                <td>

                                    <span class="badge badge-success">

                                        Rp {{ number_format($item->biaya,0,',','.') }}

                                    </span>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted">

                                    Belum ada transaksi.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Ringkasan -->

        <div class="col-lg-4 mb-4">

            <div class="card shadow border-left-primary mb-3">

                <div class="card-body">

                    <h6 class="font-weight-bold text-primary">

                        Ringkasan Data

                    </h6>

                    <hr>

                    <p class="mb-2">

                        <i class="fas fa-user-md text-primary"></i>

                        Total Dokter

                        <span class="float-right font-weight-bold">

                            {{ $totalDokter }}

                        </span>

                    </p>

                    <p class="mb-2">

                        <i class="fas fa-users text-success"></i>

                        Total Pasien

                        <span class="float-right font-weight-bold">

                            {{ $totalPasien }}

                        </span>

                    </p>

                    <p class="mb-2">

                        <i class="fas fa-file-medical text-warning"></i>

                        Total Transaksi

                        <span class="float-right font-weight-bold">

                            {{ $totalTransaksi }}

                        </span>

                    </p>

                    <p class="mb-0">

                        <i class="fas fa-wallet text-danger"></i>

                        Pendapatan

                        <span class="float-right font-weight-bold text-danger">

                            Rp {{ number_format($totalPendapatan,0,',','.') }}

                        </span>

                    </p>

                </div>

            </div>

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>Informasi</strong>

                </div>

                <div class="card-body">

                    <div class="alert alert-success mb-2">

                        <i class="fas fa-check-circle"></i>

                        Dashboard Klinik aktif.

                    </div>

                    <div class="alert alert-info mb-2">

                        <i class="fas fa-chart-line"></i>

                        Statistik diperbarui secara otomatis.

                    </div>

                    <div class="alert alert-warning mb-0">

                        <i class="fas fa-calendar-alt"></i>

                        {{ now()->translatedFormat('l, d F Y') }}

                    </div>

                </div>

            </div>

        </div>

    </div>
    @push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

// ==========================
// Grafik Pendapatan Bulanan
// ==========================

const ctxPendapatan = document.getElementById('chartPendapatan');

new Chart(ctxPendapatan, {

    type: 'line',

    data: {

        labels: [

            @foreach($pendapatanBulanan as $item)

                '{{ DateTime::createFromFormat("!m",$item->bulan)->format("M") }}',

            @endforeach

        ],

        datasets: [{

            label: 'Pendapatan',

            data: [

                @foreach($pendapatanBulanan as $item)

                    {{ $item->total }},

                @endforeach

            ],

            borderColor: '#4e73df',

            backgroundColor: 'rgba(78,115,223,.15)',

            borderWidth: 3,

            fill: true,

            tension: .4,

            pointRadius: 4

        }]

    },

    options: {

        responsive:true,

        maintainAspectRatio:false,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{

            y:{

                beginAtZero:true

            }

        }

    }

});


// ==========================
// Status pasien
// ==========================

const ctxStatus = document.getElementById('chartStatus');

new Chart(ctxStatus,{

    type:'doughnut',

    data:{

        labels: [

    @foreach($statusPasien as $item)

        '{{ $item->jenis_kelamin }}',

    @endforeach

],

        datasets:[{

            data:[

                @foreach($statusPasien as $item)

                    {{ $item->jumlah }},

                @endforeach

            ],

            backgroundColor:[

                '#4e73df',

                '#1cc88a',

                '#f6c23e',

                '#e74a3b',

                '#36b9cc'

            ],

            borderWidth:2,

            borderColor:'#ffffff'

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        cutout:'65%',

        plugins:{

            legend:{

                position:'bottom'

            }

        }

    }

});

</script>

@endpush

@endsection