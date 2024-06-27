@extends('header')

@section('content')
<div class="container">
    <h2>Tindakan</h2>

    <div class="col-md-4 mt-4">
        <a href="{{route('logistik.tx', $rekamMedis->id )}}" class="text-decoration-none text-dark" >
            <div class="card bg-primary text-white">
                <div class="card-body">

                    <h5 class="card-title">
                        <img src="{{asset('Icons/round-arrow.svg')}}" alt="round-arrow" width="28" height="24">
                        TX Logistik

                    </h5>
                    <p class="card-text">Transaksi</p>
                </div>
            </a>
        </div>
    </div>

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
