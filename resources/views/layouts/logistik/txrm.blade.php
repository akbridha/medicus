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

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <button class="btn btn-success tambah-btn" id="tambah-btn">Print <></button>
            <button id="submitButton" class="btn btn-success tambah-btn">Tambah</button>
        </div>
    </div>


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
<script>

let bmhpPilihan = [];

// Fungsi utama untuk memperbarui tabel
function updatePilihanTable() {
    let tableBody = document.querySelector('#pilihan-table tbody');
    clearTable(tableBody);

    bmhpPilihan.forEach(bmhp => {
        let newRow = createTableRow(bmhp);
        appendRowToTable(tableBody, newRow);
    });
}

// Fungsi untuk mengosongkan tabel
function clearTable(tableBody) {
    tableBody.innerHTML = '';
}

// Fungsi untuk membuat baris tabel baru
function createTableRow(bmhp) {
    return `
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
                    <input type="number" id="numberInput-${bmhp.id}" class="form-control text-center numberInput" value="${bmhp.dipakai}">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary incrementButton" data-id="${bmhp.id}">+</button>
                    </span>
                </div>
            </td>
        </tr>
    `;
}

// Fungsi untuk menambahkan baris baru ke tabel
function appendRowToTable(tableBody, row) {
    tableBody.insertAdjacentHTML('beforeend', row);
}

//apabila belum memilih bmhp apapun
function cekPilihanKosongHideHeader() {
    let tableHeader = document.querySelector('#pilihan-table thead');
    if (bmhpPilihan.length === 0) {
        tableHeader.style.display = 'none';
        console.log("array kosong");
    } else {
        tableHeader.style.display = '';
        console.log("array ada");
    }
}

document.addEventListener('DOMContentLoaded', function () {

    cekPilihanKosongHideHeader();
    document.querySelectorAll('.pilih-logistik').forEach(function (button) { /*untuk setiap button dibikinkan function*/
        button.addEventListener('click', function () {
            let logistikId = this.getAttribute('data-id');
            let logistikNama = this.getAttribute('data-nama');
            let logistikJumlah = this.getAttribute('data-jumlah');

            // Cek apakah item dengan logistikId sudah ada di array bmhpPilihan
            let itemExist = bmhpPilihan.some(function(item) {
            return item.id === logistikId; /*ini adalah persyaratan apakah ada salah satu item yang id nya sama dengan yg sudah ada*/
            });

            if (!itemExist) {
                // Jika item belum ada, tambahkan ke dalam array
                bmhpPilihan.push({
                    id: logistikId,
                    nama: logistikNama,
                    jumlah: (logistikJumlah - 1),
                    dipakai: 1
                });
                // Perbarui tabel tampilan BMHP yang dipilih
                updatePilihanTable();
            } else {
                console.log("Item dengan ID " + logistikId + " sudah ada dalam pilihan.");
            }
            cekPilihanKosongHideHeader();
        });

    });



    // Event delegation untuk tombol increment dan decrement
    document.addEventListener('click', function(event) {
        //tombol tambah
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

        //Tombol kurangi
        if (event.target.classList.contains('decrementButton')) {
            let logistikId = event.target.getAttribute('data-id');
            let item = bmhpPilihan.find(item => item.id === logistikId);

            if (item && item.dipakai > 1) {
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
            else{
                bmhpPilihan = bmhpPilihan.filter(function(obj){
                    return obj.id !== item.id ;
                })
                console.log(`id yang dihapus ${item.id}`);
                updatePilihanTable();
                cekPilihanKosongHideHeader();
            }
        }

        if (event.target.classList.contains('tambah-btn')) {
            console.log('aloha');
        }



        if (event.target.id === 'submitButton') {


            console.log(event.target.id);
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
            // window.location.href = `/rm/{{ $rekamMedis }}/periksa/${encodeURIComponent(selectedItemNames)}`;
            console.log({{ $rekamMedis }});
        })
        .catch((error) => {
            console.error('Error:', error);
        });
        }



    });




});



</script>

@endsection
