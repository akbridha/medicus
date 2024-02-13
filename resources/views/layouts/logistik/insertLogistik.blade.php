@extends('header')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Formulir Logistik
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{ route('logistik.store') }}" method="POST"> --}}
                        <form action="#" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" id="nama" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah:</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="expire_date" class="form-label">Tanggal Kadaluarsa:</label>
                                <input type="date" name="expire_date" id="expire_date" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
