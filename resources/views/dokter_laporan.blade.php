<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Dokter</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <center>
                        <h2>{{ $judul }}</h2>
                    </center>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Dokter</th>
                                <th>Nama Dokter</th>
                                <th>Spesialis</th>
                                <th>Nomor HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokter as $a)
                            <tr>
                                <td>{{ $a->id }}</td>
                                <td>{{ $a->kode_dokter }}</td>
                                <td>{{ $a->nama_dokter }}</td>
                                <td>{{ $a->spesialis }}</td>
                                <td>{{ $a->nomor_hp }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5>Mengetahui,</h5>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h5>Administrator</h5>
                </div>
            </div>
        </div>

</body>
</html>