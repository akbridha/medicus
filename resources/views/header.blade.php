<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel App</title>
    <!-- Tautan ke Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Sanitatis Notatio Medicus dr.Najmi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rm">Rekam Medis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pasien">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pasien">-</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content') <!-- Ini adalah tempat konten dari view akan ditempatkan -->
</div>

<!-- Tautan ke Bootstrap JS (Jika Anda memerlukannya) -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>


