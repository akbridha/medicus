@extends('header')

@section('content')
<div class="container">
    <h2>Edit Data Rekam Medis</h2>
{{-- @dd($rekamMedis) --}}
{{-- harus di perbaiki ganti jadi rm.update --}}
    {{-- <form method="POST" action="{{ route('rm.store') }}">
        @csrf
        <div class="form-group">
            <label for="pasien_id">ID RM:</label>
            <input type="text" class="form-control" id="pasien_id" name="pasien_id" value={{ $rekamMedis->id }} readonly>
        </div>
        <div class="form-group">
            <label for="pasien_id">Nama Pasien:</label>
            <input type="text" class="form-control" id="nama" name="Nama" value={{ $rekamMedis->pasien->Nama }} readonly>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal"  value={{ $rekamMedis->tanggal }}>
        </div>
        <div class="form-group">
            <label for="pemeriksaan">Pemeriksaan:</label>
            <input type="text" class="form-control" id="pemeriksaan" name="pemeriksaan" value={{ $rekamMedis->pemeriksaan }}>
        </div>
        <div class="form-group">
            <label for="diagnosa">Diagnosa:</label>
            <textarea class="form-control" id="diagnosa" name="diagnosa" value={{ $rekamMedis->diagnosa }}></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form> --}}
    <form method="POST" action="{{ route('rm.update', $rekamMedis->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="pasien_id">ID RM:</label>
        <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="{{ $rekamMedis->id }}" readonly>
    </div>
    <div class="form-group">
        <label for="nama">Nama Pasien:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekamMedis->pasien->Nama }}" readonly>
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal:</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $rekamMedis->tanggal }}">
    </div>
    <div class="form-group">
        <label for="pemeriksaan">Pemeriksaan:</label>
        <input type="text" class="form-control" id="pemeriksaan" name="pemeriksaan" value="{{ $rekamMedis->pemeriksaan }}">
    </div>
    <div class="form-group">
        <label for="diagnosa">Diagnosa:</label>
        <textarea class="form-control" id="diagnosa" name="diagnosa">{{ $rekamMedis->diagnosa }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection
