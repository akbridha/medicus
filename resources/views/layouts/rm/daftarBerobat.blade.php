@extends('header')

@section('content')
<div class="container">
    <h2>Pendaftaran Berobat</h2>

    <form method="POST" action="{{ route('rm.regis') }}">
        @csrf
        <input type="hidden" name="pemeriksaan" value="belum diperiksa">
        <input type="hidden" name="pasien_id" value="{{ $request->pasien_id }}">
        <div class="form-group">
            <label for="Nama">Nama Pasien:</label>
            <input type="text" class="form-control" id="Nama" name="Nama" value="{{ $request->nama }}" readonly>
        </div>

        <div class="form-group">
            <label for="tekanan_darah">Tekanan Darah</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number" class="form-control" id="tekanan_darah_sistolik" name="tekanan_darah_sistolik" placeholder="Sistolik">
                        <input type="number" class="form-control" id="tekanan_darah_diastolik" name="tekanan_darah_diastolik" placeholder="Diastolik">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <p class="small mb-0" style="font-weight: bold;">Tekanan Darah Normal</p>
                        <p class="small mb-0">Sistolik : 90-120 mmHg</p>
                        <p class="small mb-0">Diastolik : 60-80 mmHg</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="Respiratory">Respiratory:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control" id="Respiratory" name="Respiratory">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <p class="small mb-0" style="font-weight: bold;">Respiratory Normal</p>
                        <p class="small mb-0"> 16-24 breaths per minute.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="Suhu">Suhu:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control" id="Suhu" name="Suhu">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <p class="small mb-0" style="font-weight: bold;">Suhu Normal</p>
                        <p class="small mb-0"> 36.5 - 37.4 Celsius</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="heart_rate">Heart Rate:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number"  class="form-control" id="heart_rate" name="heart_rate">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <p class="small mb-0" style="font-weight: bold;">Heart Rate Normal</p>
                        <p class="small mb-0">60 - 80 bpm</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="tinggi_badan">Tinggi Badan:</label>
            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan">
        </div>
        <div class="form-group">
            <label for="berat_badan">Berat Badan:</label>
            <input type="number" class="form-control" id="berat_badan" name="berat_badan">
        </div>
        <div class="form-group">
            <label for="Keluhan">Keluhan:</label>
            <textarea class="form-control" id="keluhan" name="keluhan"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<style>
    .info-box {
        background-color: #f8f9fa; /* warna latar belakang */
    padding: 10px; /* padding di sekitar teks */
    border-radius: 4px; /* sudut melengkung */
    display: inline-block; /* membuat latar belakang menyesuaikan lebar teks */
    font-size: 0.875rem; /* ukuran font lebih kecil */
    line-height: 1.2; /* jarak antar baris lebih rapat */
}
</style>
@endsection
