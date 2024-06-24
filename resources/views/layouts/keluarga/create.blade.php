@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Keluarga</h1>
    <h3 class="mb-3">Masukkan data Pasien</h3>

    <form method="GET" action="{{ route('keluarga.pasien.find') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="kata_kunci" class="form-control" placeholder="Cari...">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    @if (is_null($pasiens))
        <div class="alert alert-info mt-4" role="alert">
            Silakan masukkan nama pasien untuk menambahkan ke dalam keluarga.
        </div>
    @elseif($pasiens->isEmpty())
        <div class="alert alert-warning" role="alert">
            Data Pasien tidak ditemukan
        </div>
    @else
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NBL</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasiens as $pasien)
                        <tr>
                            <td>{{ $pasien['NBL'] }}</td>
                            <td>{{ $pasien['Nama'] }}</td>
                            <td>{{ $pasien['Alamat'] }}</td>
                            <td>
                                <form method="POST" action="{{ route('keluarga.pasien.pilih')}}" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="Nama" value="{{ $pasien['Nama']}}">
                                    <input type="hidden" name="NBL" value="{{ $pasien['NBL']}}">
                                    <input type="hidden" name="pasien_id" value="{{ $pasien['id']}}">
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$pasiens->links()}} --}}
        </div>
    @endif

    @isset($pilihans)
        <h3 class="mb-3">Pasien yang Dipilih</h3>
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NBL</th>
                        <th>ID Pasien</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pilihans as $pilihan)
                        <tr>
                            <td>{{ $pilihan['Nama']}}</td>
                            <td>{{ $pilihan['NBL']}}</td>
                            <td>{{ $pilihan['id']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form method="POST" action="{{ route('keluarga.clear-session') }}" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-danger">Hapus pilihan</button>
        </form>

        <form method="POST" action="{{ route('keluarga.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama_keluarga">Nama Keluarga</label>
                <input type="text" class="form-control" id="nama_keluarga" placeholder="Masukkan nama keluarga"  name="nama_keluarga" required>
            </div>
            <input type="hidden" name="all_pasiens" value="{{ json_encode($pilihans) }}">
            <button type="submit" class="btn btn-primary">Kirim Semua Pasien</button>
        </form>
    @endisset
</div>
    @endsection
