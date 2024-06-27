@extends('header')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>Barang Medis Habis Pakai</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($logistiks->isEmpty())
                        <p class="text-center">Tidak ada data logistik.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Kadaluarsa</th>
                                    <th>Jumlah</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logistiks as $logistik)
                                    <tr>
                                        <td>{{ $logistik->id }}</td>
                                        <td>{{ $logistik->nama }}</td>
                                        <td>{{ $logistik->jenis }}</td>
                                        <td>{{ $logistik->kadaluarsa }}</td>
                                        <td>{{ $logistik->jumlah }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('logistik.pilihtambah') }}" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $logistik->id }}">
                                                <input type="hidden" name="nama" value="{{ $logistik->nama }}">
                                                <input type="hidden" name="jumlah" value="{{ $logistik->jumlah }}">
                                                <input type="hidden" name="id_rm" value="{{ $rekamMedis }}">
                                                <button type="submit" class="btn btn-success">Pilih</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            @if($pilihans)
                <h3 class="mb-3">BMPH yang Dipilih</h3>
                <form method="POST" action="{{ route('logistik.txupdate') }}">
                    @csrf
                    <input type="hidden" name="id_rm" value="{{ $rekamMedis }}">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tersedia</th>
                                    <th>Alokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pilihans as $pilihan)
                                    <tr>
                                        <td>{{ $pilihan['nama'] }}</td>
                                        <td>
                                            <span id="counter-{{ $pilihan['id'] }}" class="counter-box">{{ $pilihan['jumlah'] }}</span>
                                            <input type="hidden" name="logistik[{{ $pilihan['id'] }}][tersedia]" id="hiddenCounter-{{ $pilihan['id'] }}" value="{{ $pilihan['jumlah'] }}">
                                            <input type="hidden" name="logistik[{{ $pilihan['id'] }}][id]" value="{{ $pilihan['id'] }}">
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary decrementButton" data-id="{{ $pilihan['id'] }}">-</button>
                                                </span>
                                                <input type="number" id="numberInput-{{ $pilihan['id'] }}" class="form-control text-center numberInput" value="0">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary incrementButton" data-id="{{ $pilihan['id'] }}">+</button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button type="submit" class="btn btn-primary">
                            <img src="{{ asset('Icons/file-plus.svg') }}" alt="file-plus" width="25" height="27">
                            Simpan
                        </button>
                    </div>
                </form>
                        <form method="POST" action="{{ route('logistik.clear-session', $rekamMedis) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus pilihan</button>
                        </form>
            @endif
        </div>
    </div>
</div>

<style>
    .counter-box {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f0f0f0;
    }
    .input-group {
        max-width: 150px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.incrementButton').on('click', function(){
            var logistikId = $(this).data('id');
            var numberInput = $('#numberInput-' + logistikId);
            var counter = $('#counter-' + logistikId);
            var hiddenCounter = $('#hiddenCounter-' + logistikId);
            var tersedia = parseInt(counter.text());
            var dipakai = parseInt(numberInput.val());

            if(tersedia > 0){
                dipakai++;
                tersedia--;

                numberInput.val(dipakai);
                counter.text(tersedia);
                hiddenCounter.val(tersedia);
                console.log('Jumlah tersedia sekarang untuk logistik ' + logistikId + ': ' + tersedia);
            }
        });

        $('.decrementButton').on('click', function(){
            var logistikId = $(this).data('id');
            var numberInput = $('#numberInput-' + logistikId);
            var counter = $('#counter-' + logistikId);
            var hiddenCounter = $('#hiddenCounter-' + logistikId);
            var tersedia = parseInt(counter.text());
            var dipakai = parseInt(numberInput.val());

            if(dipakai > 0){
                dipakai--;
                tersedia++;

                numberInput.val(dipakai);
                counter.text(tersedia);
                hiddenCounter.val(tersedia);
                console.log('Jumlah tersedia sekarang untuk logistik ' + logistikId + ': ' + tersedia);
            }
        });
    });
</script>

@endsection
