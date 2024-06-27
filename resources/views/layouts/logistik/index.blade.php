@extends('header')
@section('content')







<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Logistik</h3>
                        <a href="{{ route('logistik.create') }}" class="btn btn-primary">
                            <img src="{{ asset('Icons/file-plus.svg') }}" alt="file-plus" width="25" height="27">
                            Tambah Logistik
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($logistiks->isEmpty())
                            <p class="text-center">Tidak ada data logistik.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Kadaluarsa</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logistiks as $logistik)
                                        <tr>
                                            <td>{{ $logistik->id }}</td>
                                            <td>{{ $logistik->nama }}</td>
                                            <td>{{ $logistik->jenis }}</td>
                                            <td>{{ $logistik->kadaluarsa }}</td>
                                            <td>{{ $logistik->jumlah }}</td>
                                            <td>
                                                <a href="{{ route('logistik.edit', $logistik->id) }}" class="btn btn-warning">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
