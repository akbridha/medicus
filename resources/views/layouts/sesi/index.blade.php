@extends('header')


@section('content')


    <div class="w-50 center border rounded px-3 py-3 mx-auto mt-5">
        <h2>Login</h2>



        {{-- @if($currentUser->isEmpty())
            <div class="alert alert-warning" role="alert">
                User not found (belum login)
            </div>
        @else
            <div class="alert alert-succes" role="alert">
                {{ $currentUser }}
            </div>
        @endif --}}

        <form action="/sesi/login" method="POST">
        {{-- <form action="#" method="POST"> --}}


            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                {{-- <input type="email" value="{{ Session::get() }}" name="email" class="form-control"> --}}
                <input type="email"  name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
        <div class="mb-3 d-grid">
            {{-- <form action="{{ route('session.logout') }}" method="POST">
                <button type="submit" class="btn btn-primary">
                    Logout
                </button>
            </form> --}}
            <a href="/sesi/logout">
                <button> Force LG</button>
            </a>
        </div>

    </div>
@endsection
