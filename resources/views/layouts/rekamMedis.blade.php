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

                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedises as $rm)
                <tr>

                    <td style="width: 130px;">{{ $rm->tanggal}}</td>
                    <td>{{ $rm->pemeriksaan }}</td>
                    <td>{{ $rm->diagnosa }}</td>


                    <td>
                        <a href="{{ $rm->id }}" class="btn btn-primary">Detail</a>
                        <a href="{{  $rm->id }}" class="btn btn-danger">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
