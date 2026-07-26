@extends('layouts.sbadmin2')

@section('isinya')

<div class="container-fluid">

<div class="card shadow">

<div class="card-header">

<h4>Edit Pasien</h4>

</div>

<div class="card-body">

<form action="{{ route('pasien.update',$pasiens->id) }}" method="POST">

@csrf
@method('PUT')

<div class="form-group">
<label>Kode Pasien</label>
<input type="text"
name="kode_pasien"
value="{{ $pasiens->kode_pasien }}"
class="form-control">
</div>

<div class="form-group">
<label>Nama Pasien</label>
<input type="text"
name="nama_pasien"
value="{{ $pasiens->nama_pasien }}"
class="form-control">
</div>

<div class="form-group">

<label>Jenis Kelamin</label>

<select name="jenis_kelamin" class="form-control">

<option value="Laki-laki"
{{ $pasiens->jenis_kelamin=='Laki-laki'?'selected':'' }}>
Laki-laki
</option>

<option value="Perempuan"
{{ $pasiens->jenis_kelamin=='Perempuan'?'selected':'' }}>
Perempuan
</option>

</select>

</div>

<div class="form-group">

<label>Status</label>

<input type="text"
name="status"
value="{{ $pasiens->status }}"
class="form-control">

</div>

<div class="form-group">

<label>Alamat</label>

<textarea
name="alamat"
class="form-control">{{ $pasiens->alamat }}</textarea>

</div>

<button class="btn btn-primary">

Update

</button>

<a href="{{ route('pasien.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

@endsection