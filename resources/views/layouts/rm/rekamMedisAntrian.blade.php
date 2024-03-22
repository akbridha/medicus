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
                    <th>Dignosis</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedises as $rekamMedis)
{{-- @dd($rm) --}}
                <tr>

                    {{-- <td style="width: 130px;">{{ $rm->pasien_id}}</td> --}}
                    <td style="width: 130px;">{{ $rekamMedis->id}}</td>
                    <td style="width: 130px;">{{ $rekamMedis->pasien->Nama}}</td>
                    <td>Belum diperiksa</td>
                    <td>---</td>


                    <td style="width: 150px;">
                        <a href="{{ route("rm.edit", $rekamMedis) }}" class="btn btn-success ">Periksa</a>
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
