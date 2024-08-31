@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Detail Pasien</h1>

    <table class="table table-bordered">
        <tr>
            <th>Nama Pasien</th>
            <td>{{ $pasien->Nama }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $pasien->NIK }}</td>
        </tr>
    </table>

    @if($pasien->keluargas->isEmpty())
        <p>Pasien ini belum dihubungkan dengan keluarga manapun.</p>
    @else
        <h2>Keluarga</h2>
        @foreach($pasien->keluargas as $keluarga)
            <table class="table table-bordered">
                <tr>
                    <th>Nama Keluarga</th>
                    <td>{{ $keluarga->nama }}</td>
                </tr>
                <tr>
                    <th>Anggota Keluarga</th>
                    <td>
                        <ul>
                            @foreach($keluarga->pasiens as $anggota)
                                <li>
                                    <a href="{{ route('rekamMedis.show', ['id' => $anggota->id]) }}" class="text-primary">
                                        {{ $anggota->Nama }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </table>
        @endforeach
    @endif

    <a href="{{ route('rm.antrian') }}" class="btn btn-primary mt-3">Kembali ke antrian</a>
</div>
@endsection
