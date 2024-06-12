@extends('header')



@section('content')
<div class="container">
    <h2>Ubah Data Pasien</h2>
    <form method="POST" action="{{ route('pasien.update', $request->pasien_id) }}">
        @csrf
        @method('PUT')
    {{-- <form method="POST" action=""> --}}
        <h6> ID pasien : {{ $request->pasien_id }}</h6>
        <div class="form-group">
            <label for="NIK">NIK:</label>
            <input type="text" class="form-control" id="NIK" name="NIK" value="{{ $request->NIK }}">
        </div>
        <div class="form-group">
            <label for="NBL">NBL:</label>
            <input type="text" class="form-control" id="NBL" name="NBL" value="{{ $request->NBL }}">
        </div>
        <div class="form-group">
            <label for="Nama">Nama:</label>
            <input type="text" class="form-control" id="Nama" name="Nama" value="{{ $request->Nama }}">
        </div>
        <div class="form-group">
            <label for="Tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="Tanggal_lahir" name="Tanggal_lahir" value="{{ $request->Tanggal_lahir }}">
        </div>
        <div class="form-group">
            <label for="Umur">Umur:</label>
            <input type="text" class="form-control" id="Umur" name="Umur" value="{{ $request->Umur }}">
        </div>
        <div class="form-group">
            <label for="Alamat">Alamat:</label>
            <input type="text" class="form-control" id="Alamat" name="Alamat" value="{{ $request->Alamat }}">
        </div>
        <div class="form-group">
            <label for="Nomor_BPJS">Nomor BPJS:</label>
            <input type="text" class="form-control" id="Nomor_BPJS" name="Nomor_BPJS" value="{{ $request->Nomor_BPJS }}">
        </div>
        <div class="form-group">
            <label for="Jenis_Kelamin">Jenis Kelamin:</label>
            <input type="text" class="form-control" id="Jenis_Kelamin" name="Jenis_Kelamin" value="{{ $request->Jenis_Kelamin }}">
        </div>
        <div class="form-group">
            <label for="Pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" id="Pekerjaan" name="Pekerjaan" value="{{ $request->Pekerjaan }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

   <div class="container">

        <div class="d-flex justify-content-end">
            <form method="GET" action="{{ route('pasien.hapus') }}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $request->pasien_id }}">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
