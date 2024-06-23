@extends('header') <!-- Anda perlu mengganti 'layouts.app' sesuai dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Rekam Medis Pasien</h1>



    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID RM</th>
                    <th>Nama</th>
                    <th>Pemeriksaan</th>
                    <th>Keluhan</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedises as $rekamMedis)
{{-- @dd($rm)<h1>{{ $rekamMedis->pasien->Nama }}</h1> --}}
                {{-- {{ dd($rekamMedis->pasien->Nama) }} --}}
                {{-- <pre>{{ json_encode($rekamMedis->pasien) }}</pre> --}}
                <tr>
                    <td style="width: 130px;">{{ $rekamMedis->id}}</td>
                    <td style="width: 130px;">{{optional($rekamMedis->pasien)->Nama}}</td>
                    <td>Belum diperiksa</td>
                    <td>{{ $rekamMedis->keluhan }}</td>


                    <td style="width: 250px;">
                        <div class="d-inline-block">
                            <!-- tombol untuk ke halaman riwayat -->
                            {{-- <a href="{{ route('rm.show', ['id' =>$rekamMedis->pasien->id ]) }}" class="btn btn-primary">Riwayat</a> --}}
                            <a href="{{ route("rm.periksa", $rekamMedis) }}" class="btn btn-success ">Periksa</a>

                        </div>


                        {{-- <form method="POST" action="{{ route('rm.create') }}" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="pasien_id" value={{ $rm->pasien->id }}>
                            <button type="submit" class="btn btn-success">Periksa</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
