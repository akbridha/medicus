@extends('header')

@section('content')
<div class="container">
    <h2>Tambah Data Pasien</h2>
    <form id="patientForm" method="POST" action="{{ route('pasien.store') }}">
        @csrf
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
            <input type="text" class="form-control" id="NBL" name="NBL" value="{{ $newNBL }}" readonly>
        </div>
        <div class="form-group">
            <label for="Nama">Nama:</label>
            <input type="text" class="form-control" id="Nama" name="Nama">
        </div>
        <div class="form-group">
            <label for="Tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="Tanggal_lahir" name="Tanggal_lahir" value="{{ old('Tanggal_lahir', '1980-01-01') }}">
        </div>
        <div class="form-group">
            <label for="Kontak">Kontak:</label>
            <input type="text" class="form-control" id="Kontak" name="Kontak">
        </div>
        <div class="form-group">
            <label for="Alamat">Alamat:</label>
            <input type="text" class="form-control" id="Alamat" name="Alamat">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="Nomor_BPJS" name="Nomor_BPJS">
        </div>
        {{-- fitur dihlilangkan --}}
        <div class="form-group">
            <input type="hidden" class="form-control" id="Nomor_BPJS" name="Nomor_BPJS" value="">
        </div>
        <div class="form-group">
            <label for="Jenis_Kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="Jenis_Kelamin" name="Jenis_Kelamin">
                <option value="" disabled selected>Belum dipilih</option>
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
                <option value="other">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" id="Pekerjaan" name="Pekerjaan">
        </div>
        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
    </form>
</div>

<script>

    function limitInput(element) {
        if (element.value.length > element.maxLength) {
            element.value = element.value.slice(0, element.maxLength);
        }
    }

</script>
@endsection
