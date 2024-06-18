@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
    <div class="container-fluid">
        <h1>Keluarga</h1>
        <h3>Masukkan data Pasien</h3>

        <form method="GET" action="{{ route('keluarga.pasien.find') }}">
            <input type="text" name="kata_kunci" placeholder="Cari...">
            <button type="submit">Cari</button>
        </form>

        @if (is_null($pasiens))
            <div class="alert alert-info mt-4" role="alert">
                Silakan masukkan nama pasien untuk menambahkan ke dalam keluarga.
            </div>
            {{-- pengecekan apabila data yang dikirim kosong --}}

        @elseif($pasiens->isEmpty())
            <div class="alert alert-warning" role="alert">
                Data Pasien tidak ditemukan
            </div>
        @else

            <div class="container-fluid ">

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
                                <td style="width: 50px;">{{ $pasien['NBL'] }}</td>
                                <td >{{ $pasien['Nama'] }}</td>
                                <td >{{ $pasien['Alamat'] }}</td>
                                <td style="width: 500px;">

                                    <div class="container">
                                        <div class="row">
                                            <div class="col text-center">

                                                <div class="d-inline-block">
                                                    <!-- tombol pilih anggota keluarga baru -->

                                                    <form method="POST" action="{{ route('keluarga.pasien.pilih')}}" class="d-inline-block">
                                                        @csrf
                                                        <input type="hidden" name="Nama" value="{{ $pasien['Nama']}}">
                                                        <input type="hidden" name="NBL" value="{{ $pasien['NBL']}}">
                                                        <input type="hidden" name="pasien_id" value="{{ $pasien['id']}}">
                                                        <button type="submit" class="btn btn-success">Daftar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- //untuk pagination halamannya --}}
                    {{-- {{$pasiens ->links()}} --}}
                </div>
            </div>



            {{-- @dd($pasiens) --}}
            @endif
            {{-- akhir pengecekan apabila data yang dikirim kosong --}}

        @isset($pilihans)

        <h3>Pasien yang Dipilih</h3>
        <table class="table">
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


        @endisset


        <div class="container">
            <!-- Tombol untuk menghapus session -->
            <form method="POST" action="{{ route('keluarga.clear-session') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Hapus pilihan</button>
            </form>
        </div>

        {{-- Form untuk mengirim semua data pasien --}}
        @if(isset($pilihans) && count($pilihans) > 0)
        <form method="POST" action="{{ route('keluarga.store') }}">
            @csrf
            <input type="hidden" name="all_pasiens" value="{{ json_encode($pilihans) }}">
            <button type="submit" class="btn btn-primary">Kirim Semua Pasien</button>
        </form>
        @endif

    </div>
    @endsection
