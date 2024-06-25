@extends('header')

@section('content')

<div class="container mt-5">
    @auth
    <h4>
    Anda Sudah Login Sebagai:
    </h4>
    <div class="alert alert-success" role="alert">
        <h1>{{ $currentUser->name }}</h1>
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>
                    <form action="/sesi/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
</div>

@endsection
