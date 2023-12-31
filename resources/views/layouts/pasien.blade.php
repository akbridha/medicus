@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Daftar Pasien</h1>

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

                        <a href="{{ route('rm.show', ['id' =>$pasien->id ]) }}" class="btn btn-primary">Detail</a>
                        {{-- <a href="{{  $pasien->id }}" class="btn btn-danger">Edit</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
