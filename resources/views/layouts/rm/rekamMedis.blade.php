@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Rekam Medis Pasien</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Pemeriksaan</th>
                    <th>Diagnosa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedises as $rekamMedis)
                <tr>
                    <td style="width: 130px;">{{ $rekamMedis->tanggal ?? '-' }}</td>
                    <td>{{ $rekamMedis->pasien->Nama ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $rekamMedis->pemeriksaan ?? 'Tidak Ada Pemeriksaan' }}</td>
                    <td>{{ $rekamMedis->diagnosa ?? 'Belum Ada Diagnosa' }}</td>
                    <td>
                        <a href="{{ route('rm.edit', $rekamMedis) }}" class="btn btn-outline-secondary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
