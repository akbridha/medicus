@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">

    <body>
    <h1>Detail Pasien</h1>

    <p><strong>Nama Pasien:</strong> {{ $pasien->Nama }}</p>
    <p><strong>NIK:</strong> {{ $pasien->NIK }}</p>

    @if($pasien->keluargas->isEmpty())
        <p>Pasien ini belum dihubungkan dengan keluarga manapun.</p>
    @else
        <h2>Keluarga</h2>
        @foreach($pasien->keluargas as $keluarga)
            <p><strong>Nama Keluarga:</strong> {{ $keluarga->nama }}</p>
            <h3>Anggota Keluarga</h3>
            <ul>
                @foreach($keluarga->pasiens as $anggota)
                    <li>
                        <a href="{{ route('rm.show', ['id' => $anggota->id]) }}" class="text-primary">
                        {{ $anggota->Nama }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    @endif

    <a href="{{ route('rm.antrian') }}">Kembali ke antrian</a>
</body>
</div>
@endsection
