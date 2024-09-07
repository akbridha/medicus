@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container mt-5">
        <h3>Daftar Antrian Berobat</h3>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID RM</th>
                    <th>Nama</th>
                    <th>Pemeriksaan</th>
                    <th>Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedises as $rekamMedis)
                    <tr>
                        <td style="width: 130px;">{{ $rekamMedis->id }}</td>
                        <td style="width: 130px;">{{ optional($rekamMedis->pasien)->Nama }}</td>
                        <td>Belum diperiksa</td>
                        <td>{{ $rekamMedis->keluhan }}</td>
                        <td style="width: 250px;">
                            <div class="action-buttons d-inline-block">
                                <!-- tombol untuk ke halaman periksa -->
                                <a href="{{ route('rm.periksa', $rekamMedis) }}" class="btn btn-success btn-block">Periksa</a>
                                <div class="btn-group mt-2" role="group" aria-label="Action Buttons">
                                    <a href="{{ route('rm.showlist', ['id' => $rekamMedis->pasien->id ]) }}" class="btn btn-primary">Riwayat</a>
                                    <a href="{{ route('keluarga.find', ['id' => $rekamMedis->pasien->id ]) }}" class="btn btn-info">Keluarga</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
