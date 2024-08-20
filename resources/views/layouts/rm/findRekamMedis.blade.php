@extends('header')
{{-- Menampilkan riwayat rekam medis yang sudah ada --}}
{{-- dicari berdasarkan id pasien --}}
@section('content')
<div class="container">
    <h1 class="my-4">Rekam Medis Pasien</h1>

    @if (session()->has('key'))
        <div class="alert alert-{{ session('key') == 'Berhasil' ? 'success' : 'danger' }}">
            {{ session('key') == 'Berhasil' ? 'Berhasil Menambahkan Data' : 'Gagal' }}
        </div>
        @if (session('key') != 'Berhasil')
            <div class="alert alert-danger">
                {{ session('key') }}
            </div>
        @endif
        @php
            session()->forget('key');
        @endphp
    @endif

    <div class="row mb-4">
        <div class="col-md-1">
            <p><strong>Data Pasien</strong></p>
        </div>
        <div class="col-md-6">
            @if($rekamMedises->isNotEmpty())
                <p><strong>Nama:</strong> {{ $rekamMedises->first()->pasien->Nama }}</p>
                <p><strong>Gender:</strong> {{ $rekamMedises->first()->pasien->Jenis_Kelamin }}</p>
                <p><strong>Umur:</strong> {{ $rekamMedises->first()->pasien->Umur }}</p>
                <p><strong>Alamat:</strong> {{ $rekamMedises->first()->pasien->Alamat }}</p>
                <p><strong>Pekerjaan:</strong> {{ $rekamMedises->first()->pasien->Pekerjaan }}</p>
            @else
                <p>Tidak ada data pasien yang tersedia (Pasien belum pernah berobat)</p>
            @endif
        </div>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>Tanggal</th>
            <th>Pemeriksaan</th>
            <th>Diagnosa</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekamMedises as $rm)
            <tr onclick="window.location.href='{{ route('rekamMedis.show', $rm->id) }}'">
                <td style="width: 130px;">{{ $rm->tanggal }}</td>
                <td>{{ $rm->pemeriksaan }}</td>
                <td>{{ $rm->diagnosa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>

<style>
    .container h1 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #f8f9fa;
    }

    .alert {
        margin-top: 1rem;
    }
</style>
@endsection
