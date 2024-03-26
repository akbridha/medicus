@extends('header')



@section('content')
<div class="container">
    <h2>Tambah Data Pasien</h2>
    <form method="POST" action="{{ route('pasien.store') }}">
        @csrf
    {{-- <form method="POST" action=""> --}}
        @csrf
        <div class="form-group">
            <label for="NIK">NIK:</label>
            <input type="text" class="form-control" id="NIK" name="NIK">
        </div>
        <div class="form-group">
            <label for="NBL">NBL:</label>
            <input type="text" class="form-control" id="NBL" name="NBL" value="{{ $newNBL }}" readonly>
        </div>
        <div class="form-group">
            <label for="Nama">Nama:</label>
            <input type="text" class="form-control" id="Nama" name="Nama">
        </div>
        <div class="form-group">
            <label for="Tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="Tanggal_lahir" name="Tanggal_lahir">
        </div>
        <div class="form-group">
            <label for="Umur">Umur:</label>
            <input type="text" class="form-control" id="Umur" name="Umur">
        </div>
        <div class="form-group">
            <label for="Alamat">Alamat:</label>
            <input type="text" class="form-control" id="Alamat" name="Alamat">
        </div>
        <div class="form-group">
            <label for="Nomor_BPJS">Nomor BPJS:</label>
            <input type="text" class="form-control" id="Nomor_BPJS" name="Nomor_BPJS">
        </div>
        <div class="form-group">
            <label for="Jenis_Kelamin">Jenis Kelamin:</label>
            <input type="text" class="form-control" id="Jenis_Kelamin" name="Jenis_Kelamin">
        </div>
        <div class="form-group">
            <label for="Pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" id="Pekerjaan" name="Pekerjaan">
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
    </form>
</div>
@endsection
