@extends('header')

@section('content')
<div class="container">
    <h2>Pendaftaran Berobat</h2>

    <form method="POST" action="{{ route('rm.regis')}}">
    @csrf
    <input type="hidden" name="pemeriksaan" value="belum diperiksa">
    <input type="hidden" name="pasien_id" value="{{ $request->pasien_id }}">
    <div class="form-group">
        <label for="Nama">Nama Pasien:</label>
        <input type="text" class="form-control" id="Nama" name="Nama" value="{{ $request->nama }} " >
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal:</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $request->tanggal }}">
    </div>
    <div class="form-group">
        <label for="tekanan_darah">Tekanan Darah</label>
        <input type="text" class="form-control" id="tekanan_darah" name="tekanan_darah" >
    </div>
    <div class="form-group">
        <label for="tinggi_badan">Tinggi Badan:</label>
        <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" >
    </div>
    <div class="form-group">
        <label for="berat_badan">Berat Badan:</label>
        <input type="text" class="form-control" id="berat_badan" name="berat_badan" >
    </div>
    <div class="form-group">
        <label for="Keluhan">Keluhan:</label>
        <textarea class="form-control" id="keluhan" name="keluhan"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection
