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

                                        <button type="button" class="btn btn-success pilih-logistik" 
                                        data-id="{{ $logistik->id }}" 
                                        data-nama="{{ $logistik->nama }}" 
                                        data-jumlah="{{ $logistik->jumlah }}">Pilih</button>

                                            <!-- <form method="POST" action="{{ route('logistik.pilihtambah') }}" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $logistik->id }}">
                                                <input type="hidden" name="nama" value="{{ $logistik->nama }}">
                                                <input type="hidden" name="jumlah" value="{{ $logistik->jumlah }}">
                                                <input type="hidden" name="id_rm" value="{{ $rekamMedis }}">
                                                <button type="submit" class="btn btn-success">Pilih</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            @if($pilihans)
                <h3 class="mb-3">BMHP yang Dipilih</h3>
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



                                            <input type="hidden"
                                            name="logistik[{{ $pilihan['id'] }}][tersedia]"
                                            id="hiddenCounter-{{ $pilihan['id'] }}"
                                            value="{{ $pilihan['jumlah'] }}">
                                            <input type="hidden" name="logistik[{{ $pilihan['id'] }}][id]" value="{{ $pilihan['id'] }}">
                                            <input type="hidden" name="logistik[{{ $pilihan['id'] }}][nama]" value="{{ $pilihan['nama'] }}">
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
    <button class="btn btn-success" id="tambah-btn">Tambah</button>

    <button id="submitButton">Kirim Data</button>


    <table id="pilihan-table" class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tersedia</th>
            <th>Alokasi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data dari array `pilihans` akan diisi di sini -->
    </tbody>
</table>
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
<script>let bmhpPilihan = [];

document.addEventListener('DOMContentLoaded', function () {
    toggleTableHeader();
    document.querySelectorAll('.pilih-logistik').forEach(function (button) {
        button.addEventListener('click', function () {
            let logistikId = this.getAttribute('data-id');
            let logistikNama = this.getAttribute('data-nama');
            let logistikJumlah = this.getAttribute('data-jumlah');

            // Cek apakah item dengan logistikId sudah ada di array bmhpPilihan
            let itemExist = bmhpPilihan.some(function(item) {
            return item.id === logistikId;
            });

            if (!itemExist) {
                // Jika item belum ada, tambahkan ke dalam array
                bmhpPilihan.push({
                    id: logistikId,
                    nama: logistikNama,
                    jumlah: logistikJumlah,
                    dipakai: 0
                });
                // Perbarui tabel tampilan BMHP yang dipilih
                updatePilihanTable();
            } else {
                console.log("Item dengan ID " + logistikId + " sudah ada dalam pilihan.");
            }
            toggleTableHeader();
        });
    });



    // Event delegation untuk tombol increment dan decrement
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('incrementButton')) {
            let logistikId = event.target.getAttribute('data-id');
            let item = bmhpPilihan.find(item => item.id === logistikId);

            if (item && item.jumlah > item.dipakai) {
                item.dipakai++;
                item.jumlah--;

                // Update display
                let numberInput = document.getElementById('numberInput-' + logistikId);
                let counter = document.getElementById('counter-' + logistikId);
                let hiddenCounter = document.getElementById('hiddenCounter-' + logistikId);

                numberInput.value = item.dipakai;
                counter.textContent = item.jumlah;
                hiddenCounter.value = item.jumlah;

                console.log('Jumlah tersedia sekarang untuk logistik ' + logistikId + ': ' + item.jumlah);
            }
        }

        if (event.target.classList.contains('decrementButton')) {
            let logistikId = event.target.getAttribute('data-id');
            let item = bmhpPilihan.find(item => item.id === logistikId);

            if (item && item.dipakai > 0) {
                item.dipakai--;
                item.jumlah++;

                // Update display
                let numberInput = document.getElementById('numberInput-' + logistikId);
                let counter = document.getElementById('counter-' + logistikId);
                let hiddenCounter = document.getElementById('hiddenCounter-' + logistikId);

                numberInput.value = item.dipakai;
                counter.textContent = item.jumlah;
                hiddenCounter.value = item.jumlah;

                console.log('Jumlah tersedia sekarang untuk logistik ' + logistikId + ': ' + item.jumlah);
            }
        }
    });

        // Event listener untuk tombol "Tambah"
    document.getElementById("tambah-btn").addEventListener('click', function(){
        console.log(bmhpPilihan);
    });

    document.getElementById('submitButton').addEventListener('click', function() {
        let selectedItemNames = bmhpPilihan.map(item => item.nama).join(',');
        fetch('{{ route("logistik.txupdate") }}', { // Ganti dengan nama route Anda
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF Laravel
            },
            body: JSON.stringify({ bmhpUpdate: bmhpPilihan })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Redirect atau tindakan lainnya setelah sukses
            window.location.href = `/rm/{{ $rekamMedis }}/periksa/${encodeURIComponent(selectedItemNames)}`;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });



});

function updatePilihanTable() {
    // Kosongkan tabel sebelum diisi ulang
    let tableBody = document.querySelector('#pilihan-table tbody');
    tableBody.innerHTML = '';

    // Tambahkan setiap item di `bmhpPilihan` ke tabel
    bmhpPilihan.forEach(bmhp => {
        let newRow = `
            <tr>
                <td>${bmhp.nama}</td>
                <td>
                    <span id="counter-${bmhp.id}" class="counter-box">${bmhp.jumlah}</span>
                    <input type="hidden" name="logistik[${bmhp.id}][tersedia]" id="hiddenCounter-${bmhp.id}" value="${bmhp.jumlah}">
                    <input type="hidden" name="logistik[${bmhp.id}][id]" value="${bmhp.id}">
                    <input type="hidden" name="logistik[${bmhp.id}][nama]" value="${bmhp.nama}">
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary decrementButton" data-id="${bmhp.id}">-</button>
                        </span>
                        <input type="number" id="numberInput-${bmhp.id}" class="form-control text-center numberInput" value="0">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary incrementButton" data-id="${bmhp.id}">+</button>
                        </span>
                    </div>
                </td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', newRow);
    });

    
}
function toggleTableHeader() {
let tableHeader = document.querySelector('#pilihan-table thead');
    if (bmhpPilihan.length === 0) {
        tableHeader.style.display = 'none';
        console.log("array kosong");
    } else {
        tableHeader.style.display = '';
        console.log("array ada");
    }
}



</script>

@endsection
