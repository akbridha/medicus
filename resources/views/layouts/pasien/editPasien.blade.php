@extends('header')

@section('content')
<div class="container mt-5">
    <h2>Ubah Data Pasien</h2>
    <form method="POST" action="{{ route('pasien.update', $request->pasien_id) }}">
        @csrf
        @method('PUT')
        <h6>ID Pasien: {{ $request->pasien_id }}</h6>
        <div class="form-group">
            <label for="NIK">NIK:</label>
            <div class="form-row">
                <div class="col-md-1">
                    <input type="number" class="form-control" id="NIK1" name="nik_pertama" maxlength="4" oninput="limitInput(this)">
                </div>
                <div class="col-md-1">
                    <input type="number" class="form-control" id="NIK2" name="nik_kedua" maxlength="4" oninput="limitInput(this)">
                </div>
                <div class="col-md-1">
                    <input type="number" class="form-control" id="NIK3" name="nik_ketiga" maxlength="4" oninput="limitInput(this)">
                </div>
                <div class="col-md-1">
                    <input type="number" class="form-control" id="NIK4" name="nik_keempat" maxlength="4" oninput="limitInput(this)">
                </div>
            </div>
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
            <label for="Alamat">Alamat:</label>
            <input type="text" class="form-control" id="Alamat" name="Alamat" value="{{ $request->Alamat }}">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="Nomor_BPJS" name="Nomor_BPJS" value="{{ $request->Nomor_BPJS }}">
        </div>
        <div class="form-group">
            <label for="Jenis_Kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="Jenis_Kelamin" name="Jenis_Kelamin">
                <option value="male" {{ $request->Jenis_Kelamin == 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ $request->Jenis_Kelamin == 'female' ? 'selected' : '' }}>Perempuan</option>
                <option value="other" {{ $request->Jenis_Kelamin == 'other' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" id="Pekerjaan" name="Pekerjaan" value="{{ $request->Pekerjaan }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <div class="d-flex justify-content-end mt-3">
        <form method="GET" action="{{ route('pasien.hapus') }}">
            @csrf
            <input type="hidden" id="id" name="id" value="{{ $request->pasien_id }}">
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nik = "{{ $request->NIK }}";
        // if (nik.length === 15) {
            document.getElementById('NIK1').value = nik.length;
            document.getElementById('NIK1').value = nik.slice(0, 4);
            document.getElementById('NIK2').value = nik.slice(4, 8);
            document.getElementById('NIK3').value = nik.slice(8, 12);
            document.getElementById('NIK4').value = nik.slice(12, 16);
        // }
    });

    function limitInput(element) {
        if (element.value.length > element.maxLength) {
            element.value = element.value.slice(0, element.maxLength);
        }
    }
</script>
@endsection
