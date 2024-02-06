@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Daftar Pasien</h1>


@if (session()->has('key'))


@if (session('key')== 'Berhasil')

<div class="alert alert-success">
    Berhasil Menambahkan Data
</div>
@else
<div class="alert alert-danger">
    Gagal
</div>
<div class="alert alert-danger">
    {{ session('key') }}
</div>

@endif

@php
        session()->forget('key');
@endphp

@endif

    <a href="{{route('pasien.create')}}" class="btn btn-info mb-4 float-right">Tambah</a>
    <form method="GET" action="{{ route('cari') }}">
        <input type="text" name="kata_kunci" placeholder="Cari...">
        <button type="submit">Cari</button>
    </form>


    {{-- pengecekan apabila data yang dikirim kosong --}}
    @if($pasiens->isEmpty())
        <div class="alert alert-warning" role="alert">
            Data Pasien tidak ditemukan
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NBL</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasiens as $pasien)
                        <tr>
                            <td style="width: 100px;">{{ $pasien->NBL }}</td>
                            <td>{{ $pasien->Nama }}</td>
                            <td>{{ $pasien->Alamat }}</td>
                            <td style="width: 150px;">
                                {{-- tombol kunjungan baru         --}}
                                <form method="POST" action="{{ route('rm.create') }}">
                                    @csrf
                                    <input type="hidden" name="id_pasien" value={{ $pasien->id }}>
                                    <button type="submit" class="btn btn-success mb-2">Kunjungan Baru</button>
                                </form>
                                {{-- tombol untuk ke halaman riwayat --}}
                                <a href="{{ route('rm.show', ['id' =>$pasien->id ]) }}" class="btn btn-primary mb-3">Riwayat</a>
                                {{-- tombol untuk ke halaman edit pasien --}}

                                <a href="{{ route('pasien.edit', ['id' =>$pasien->id ]) }}" class="btn btn-warning mb-3">Ubah Data</a>
                                {{-- <form method="POST" action="{{route('pasien.edit')}}">
                                    @csrf
                                    <input type="hidden" name="id_pasien" value={{ $pasien->id }}>
                                    <button type="submit" class="btn btn-warning mb-2">Edit Pasien</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- //untuk pagination halamannya --}}
            {{$pasiens ->links()}}
        </div>

    @endif
    {{-- akhir pengecekan apabila data yang dikirim kosong --}}
</div>
@endsection
