@extends('header')

@section('content')
<div class="container">
    <h2>Tambah Data Rekam Medis</h2>
    <form method="POST" action="{{ route('rm.store') }}">
        @csrf
        <div class="form-group">
            <label for="pasien_id">ID Pasien:</label>
            <input type="text" class="form-control" id="pasien_id" name="pasien_id" value={{ $request->pasien_id }} readonly>

        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
        </div>
        <div class="form-group">
            <label for="pemeriksaan">Pemeriksaan:</label>
            <input type="text" class="form-control" id="pemeriksaan" name="pemeriksaan">
        </div>
        <div class="form-group">
            <label for="diagnosa">Diagnosa:</label>
            <textarea class="form-control" id="diagnosa" name="diagnosa"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
