@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
    <div class="container-fluid">
        <div class="container">
            <h1>Daftar Keluarga dan Pasien</h1>
            <a href="{{route('keluarga.create')}}" class="btn btn-info mb-4 float-right">Tambah</a>
                {{-- pengecekan apabila data yang dikirim kosong --}}

            @if($keluargas->isEmpty())
                <div class="container-fluid w-75">

                    <div class="alert alert-warning" role="alert">
                        Data Pasien tidak ditemukan
                    </div>
                </div>
            @else
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama Keluarga</th>
                            <th>Nama Pasien</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keluargas as $keluarga)
                            <tr>
                                <td>{{ $keluarga->nama }}</td>
                                <td>
                                    <ul>
                                        @foreach($keluarga->pasiens as $pasien)
                                            <li>{{ $pasien->Nama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <form action="{{ route('keluarga.pasien.destroy',  $keluarga->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{-- akhir pengecekan apabila data yang dikirim kosong --}}



        {{--
        <div class="container">
            <!-- Tombol untuk menghapus session -->
            <form method="POST" action="{{ route('keluarga.clear-session') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Hapus pilihan</button>
            </form>
        </div> --}}

        {{-- Form untuk mengirim semua data pasien --}}
        {{-- @if(isset($pilihans) && count($pilihans) > 0)
        <form method="POST" action="{{ route('keluarga.store') }}">
            @csrf
            <input type="text" class="form-control" id="nama_keluarga" name="nama_keluarga">
            <input type="hidden" name="all_pasiens" value="{{ json_encode($pilihans) }}">
            <button type="submit" class="btn btn-primary">Kirim Semua Pasien</button>
        </form>
        @endif --}}

    </div>
    @endsection
