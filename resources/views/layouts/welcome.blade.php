@extends('header')

@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


    </head>
    <body class="bg-secondary">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4 mt-4">
                    <a href="{{route('pasien.index')}}" class="text-decoration-none ">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{-- <i class="bi bi-folder-plus"></i> --}}
                                    <img src="{{asset('Icons/folder-plus.svg')}}" alt="folder-plus" widht="28" height="24">
                                    Rekam Medis
                                </h5>
                                <p class="card-text">Kunjungan Berobat</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mt-4">
                    <a href="{{route('pasien.create')}}" >
                    <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <img src="{{asset("Icons/person-fill-add.svg")}}" alt="person-fill-add" width="28" height="24" >
                                    Peserta Baru
                                </h5>
                                <p class="card-text">Pendaftaran Pasien</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mt-4">
                    <a href="{{route('logistik.index')}}" class="text-decoration-none text-dark" >
                        <div class="card bg-warning text-white">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <img src="{{asset('Icons/round-arrow.svg')}}" alt="round-arrow" width="28" height="24">
                                    Logistik

                                </h5>
                                <p class="card-text">Manajemen Stok</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- row --}}

            <div class="row mt-4">
                <div class="col-md-5">
                    <div class="card" style="height: 250px;">
                        <div class="card-body mt-5">
                            <h5 class="card-title">Jumlah Pasien Terdaftar</h5>
                            <p class="card-text">
                                <img src="{{ asset('Icons/person-bulat.svg') }}" alt="person bulat">
                                742 Orang.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card" style="height: 250px;">
                        <div class="card-body mt-5">
                            <h5 class="card-title">Pasien Baru Bulan Ini</h5>
                            <p class="card-text">
                                <img src="{{ asset('Icons/person-bulat.svg') }}" alt="person bulat">
                                23 Orang.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>


            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">

                            <div class="card">
                                <a class="nav-link" href="#">  <img src="{{asset('Icons/calendar-week.svg')}}" alt="calendar-week" width="28" height="24"> {{ strftime('%d %B %Y', strtotime(date('d-m-Y'))) }}</a>
                            </div>

                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Tanggal hari ini adalah: {{ date('Y-m-d') }}</p>
                </div>
            </div>

        </div>
    </body>

</html>

@endsection
