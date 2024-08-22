@extends('header')

@section('content')
    <div class="container-fluid">
        <h1>Daftar Pasien</h1>

        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('pasien.create') }}" class="btn btn-info">Tambah</a>
            <a href="{{ route('keluarga.index') }}" class="btn btn-primary">Keluarga</a>
        </div>

        <form method="GET" action="{{ route('pasien.cari') }}" class="form-inline mb-3">
            <input type="text" name="kata_kunci" class="form-control mr-2" placeholder="Cari..." value="{{ request('kata_kunci') }}">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </form>

        @if($pasiens->isEmpty())
            <div class="alert alert-warning" role="alert">
                Data Pasien tidak ditemukan
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 50px;">NBL</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th style="width: 300px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pasiens as $pasien)
                        <tr>
                            <td>{{ $pasien->NBL }}</td>
                            <td>{{ $pasien->Nama }}</td>
                            <td>{{ $pasien->Alamat }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if(Auth::check() && Auth::user()->role === 'docter')
                                        <a href="{{ route('rm.showlist', ['id' => $pasien->id]) }}" class="btn btn-primary btn-sm">Riwayat</a>
                                    @endif
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <form method="POST" action="{{ route('pasien.edit') }}" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                                            <button type="submit" class="btn btn-warning btn-sm">Ubah Data</button>
                                        </form>
                                        <form method="POST" action="{{ route('rm.daftar') }}" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                                            <input type="hidden" name="nama" value="{{ $pasien->Nama }}">
                                            <button type="submit" class="btn btn-success btn-sm">Daftar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $pasiens->appends(['kata_kunci' => request('kata_kunci')])->links() }}
            </div>
        @endif
    </div>
@endsection
