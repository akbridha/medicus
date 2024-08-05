<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medika</title>
    <!-- Tautan ke Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-s27UV2zso+G8KLeT1hQcq1gL8Fy8tO0oMf8tF5A51P5B9RLxGOdsR8vYwWdJVy7ehADZhJ/zBv/ZsRV05mj0Dg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- link untuk bootstrap icon via online --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            padding-top: 56px; /* Adjust this value based on the height of your navbar */
        }
        .content-container {
            margin-top: 20px; /* Adjust this value to provide the desired margin */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-info fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{asset('Icons/person-rolodex.svg')}}" alt="folder-person">
                Medicus dr.Najmi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/rm">Rekam Medis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pasien">
                            <img src="{{ asset('Icons/pasien-list.svg') }}" alt="List">
                            Pasien
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/sesi">
                            <div class="container bg-light" style="border-radius: 10px;">
                                <img src="{{ asset('Icons/person-bulat.svg') }}" alt="person"/>
                                {{ $currentUser->name ?? 'Login' }}
                            </div>
                        </a> <!-- Tambahkan ikon login -->
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/sesi/logout">
                            <div class="container " style="border-radius: 10px;">
                                <img src="{{ asset('Icons/box-arrow.svg') }}" alt="person"/>
                            </div>
                        </a> <!-- Tambahkan ikon login -->
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


<div class="container-fluid mt-10">
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $item )
                <li>
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session()->has('key'))
        <div class="alert alert-info mt-3">
            {{ session('key') }}
        </div>
        @php
            session()->forget('key');
        @endphp
    @endif
    @yield('content') <!-- Ini adalah tempat konten dari view akan ditempatkan -->
</div>


{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
<script src="{{asset('js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
