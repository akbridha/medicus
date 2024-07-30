@extends('header')

@section('content')
<div class="container">
    <h2>Tambah Data Pasien</h2>
    <form id="patientForm" method="POST" action="{{ route('pasien.store') }}">
        @csrf
        <div class="form-group">
            <label for="NIK">NIK:</label>
            <input type="text" class="form-control" id="NIK" name="NIK" maxlength="19">
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
        <!-- <div class="form-group">
            <label for="Umur">Umur:</label>
            <input type="text" class="form-control" id="Umur" name="Umur">
        </div> -->
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
document.addEventListener('DOMContentLoaded', function() {
    const nikInput = document.getElementById('NIK');
    const form = document.getElementById('patientForm');

    nikInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D+/g, ''); // Remove all non-digit characters

        if (value.length > 16) {
            value = value.substring(0, 16); // Truncate to 16 digits
        }

        let formattedValue = '';

        for (let i = 0; i < value.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formattedValue += ' ';
            }
            formattedValue += value[i];
        }

        e.target.value = formattedValue;
    });

    nikInput.addEventListener('keypress', function(e) {
        let value = e.target.value.replace(/\s+/g, ''); // Remove spaces for length check

        if (value.length >= 16 && !isNaN(String.fromCharCode(e.which))) {
            e.preventDefault(); // Prevent input if already 16 digits
        }
    });

    form.addEventListener('submit', function(e) {
        nikInput.value = nikInput.value.replace(/\s+/g, ''); // Remove all spaces before submitting the form
    });
});
</script>
@endsection
