@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Rekam Medis Pasien</h1>



    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pemeriksaan</th>
                    <th>Dignosis</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedises as $rekamMedis)
                <tr>

                    <td style="width: 130px;">{{ $rekamMedis->tanggal}}</td>
                    <td>{{ $rekamMedis->pemeriksaan }}</td>
                    <td>{{ $rekamMedis->diagnosa }}</td>


                    <td>
                        <a href="{{ route("rm.edit", $rekamMedis) }}" class="btn btn-outline-secondary ">oprek</a>
                        {{-- <a href="#" class="btn btn-outline-secondary">Edit</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
