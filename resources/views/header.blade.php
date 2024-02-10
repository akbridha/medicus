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
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
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
                        <a class="nav-link" href="#">
                            <div class="container bg-light style="border-radius: 50px;">

                                <img src="{{ asset('Icons/person-bulat.svg') }}" alt="person"/>
                                Admin
                            </div>
                        </a> <!-- Tambahkan ikon login -->

                    </li>
                </ul>
            </div>
        </div>
    </nav>


<div class="container-fluid">
    @yield('content') <!-- Ini adalah tempat konten dari view akan ditempatkan -->
</div>

<!-- Tautan ke Bootstrap JS (Jika Anda memerlukannya) -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
