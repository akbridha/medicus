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
                <div class="col-md-4 mt-4"> <!-- Tambahkan kelas mt-4 di sini -->
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-folder-plus"></i>
                                    Rekam Medis
                            </h5>
                            <p class="card-text">This is a success card in Bootstrap 4.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4"> <!-- Tambahkan kelas mt-4 di sini -->
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">

                                <i class="bi bi-person-fill-add"></i>
                                Peserta Baru
                            </h5>
                            <p class="card-text">This is a warning card in Bootstrap 4.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4"> <!-- Tambahkan kelas mt-4 di sini -->
                    <div class="card bg-warning text-white">
                        <div class="card-body">

                            <h5 class="card-title">
                                <i class="bi bi-pencil-square"></i>
                                Ubah Data
                            </h5>
                            <p class="card-text">This is an info card in Bootstrap 4.</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- row --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tanggal Hari Ini</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Tanggal hari ini adalah: {{ date('Y-m-d') }}</p>
                </div>
            </div>

        </div>
    </body>

</html>

@endsection
