@extends('header')

@section('content')
    <div class="container-fluid">
        <h1>Daftar Pasien</h1>

        <a href="{{ route('pasien.create') }}" class="btn btn-info mb-4 float-right">Tambah</a>
        <form method="GET" action="{{ route('pasien.cari') }}">
            <input type="text" name="kata_kunci" placeholder="Cari..." value="{{ request('kata_kunci') }}">
            <button type="submit">Cari</button>
        </form>

        @if($pasiens->isEmpty())
            <div class="alert alert-warning" role="alert">
                Data Pasien tidak ditemukan
            </div>
        @else
            <div class="container-fluid">
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
                                <td style="width: 50px;">{{ $pasien->NBL }}</td>
                                <td>{{ $pasien->Nama }}</td>
                                <td>{{ $pasien->Alamat }}</td>
                                <td style="width: 500px;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col text-center">
                                                <div class="d-inline-block">
                                                    <a href="{{ route('rm.show', ['id' => $pasien->id]) }}" class="btn btn-primary">Riwayat</a>
                                                </div>
                                                <div class="d-inline-block">
                                                    <form method="POST" action="{{ route('pasien.edit') }}">
                                                        @csrf
                                                        <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                                                        <input type="hidden" name="Nama" value="{{ $pasien->Nama }}">
                                                        <input type="hidden" name="NIK" value="{{ $pasien->NIK }}">
                                                        <input type="hidden" name="NBL" value="{{ $pasien->NBL }}">
                                                        <input type="hidden" name="Tanggal_lahir" value="{{ $pasien->Tanggal_lahir }}">
                                                        <input type="hidden" name="Umur" value="{{ $pasien->Umur }}">
                                                        <input type="hidden" name="Alamat" value="{{ $pasien->Alamat }}">
                                                        <input type="hidden" name="Nomor_BPJS" value="{{ $pasien->Nomor_BPJS }}">
                                                        <input type="hidden" name="Jenis_Kelamin" value="{{ $pasien->Jenis_Kelamin }}">
                                                        <input type="hidden" name="Pekerjaan" value="{{ $pasien->Pekerjaan }}">
                                                        <button type="submit" class="btn btn-warning">Ubah Data</button>
                                                    </form>
                                                </div>
                                                <div class="d-inline-block">
                                                    <form method="POST" action="{{ route('rm.daftar') }}" class="d-inline-block">
                                                        @csrf
                                                        <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                                                        <input type="hidden" name="nama" value="{{ $pasien->Nama }}">
                                                        <input type="hidden" name="tanggal" value="{{ now()->format('Y-m-d') }}">
                                                        <input type="hidden" name="pemeriksaan" value="belum diperiksa">
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

                    {{ $pasiens->appends(['kata_kunci' => request('kata_kunci')])->links() }} <!-- Menampilkan link pagination dengan parameter pencarian -->
                </div>
                <div class="col-md-2">
                    <a href="{{ route('keluarga.index') }}" class="btn btn-primary mb-4 float-right">Keluarga</a>
                </div>
            </div>
        @endif
    </div>
@endsection
