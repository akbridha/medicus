@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Rekam Medis Pasien</h1>


    @if (session()->has('key'))


        @if (session('key')== 'Berhasil')

        <div class="alert alert-success">
            Berhasil Menambahkan Data
        </div>
        @else
        <div class="alert alert-danger">
            Gagal
        </div>
        <div class="alert alert-danger">
            {{ session('key') }}
        </div>

        @endif

        @php
                session()->forget('key');
        @endphp
@endif


    <div class="container">
        <div class="row">
            <!-- Kolom Kiri dengan Garis Tebal -->
            <div class="col-md-1 border-right">
                <p><strong>Nama: </strong></p>

            </div>
            <!-- Kolom Kanan -->
            <div class="col-md-6">
               <p>Semua Rekam Medis</p>

            </div>
        </div>
    </div>


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



                        {{-- <a href="{{ $rm->id }}" class="btn btn-primary">Detail</a>
                        <a href="{{  $rm->id }}" class="btn btn-danger">Edit</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
