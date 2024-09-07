@extends('header')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Logistik
                    </div>
                    <div class="card-body">
                        <form action="{{ route('logistik.update', $logistik->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $logistik->nama }}">
                            </div>

                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis:</label>
                                <input type="text" name="jenis" id="jenis" class="form-control" value="{{ $logistik->jenis }}">
                            </div>

                            <div class="mb-3">
                                <label for="kadaluarsa" class="form-label">Tanggal Kadaluarsa:</label>
                                <input type="date" name="kadaluarsa" id="kadaluarsa" class="form-control" value="{{ $logistik->kadaluarsa }}">
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah:</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $logistik->jumlah }}">
                            </div>

                                <button type="submit" class="btn btn-primary">Update</button>

                        </form>
                        <div class="container-fluid">
                            {{-- tombol hapus --}}
                            <form action="{{ route('logistik.destroy', $logistik->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right">Hapus</button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
