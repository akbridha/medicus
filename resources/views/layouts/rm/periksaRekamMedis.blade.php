@extends('header')

@section('content')
<style>

    .counter-box {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f0f0f0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 1em;
        font-family: 'Arial', sans-serif;
    }

    table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    table th, table td {
        border: 1px solid #dddddd;
        padding: 12px 15px;
    }

    table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .modal-size{
        max-width: 70%;
    }
</style>
    <div class="container-fluid" style="width: 90%;">
        <div class="row">
            <div class="col-md-6"> <!-- Menggunakan setengah lebar -->
                <!-- Konten kolom kiri -->
                <h2>Tindakan</h2>
                <div class="mt-4">
                    <a href="{{route('logistik.tx', $rekamMedis->id )}}" class="text-decoration-none text-dark">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <img src="{{asset('Icons/round-arrow.svg')}}" alt="round-arrow" width="28" height="24">
                                    TX Logistik
                                </h5>
                                <p class="card-text">Transaksi</p>
                            </div>
                        </div>
                    </a>
                </div>
                <form method="POST" action="{{ route('rm.update', [$rekamMedis->id, 'rm.antrian']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="pasien_id">ID RM:</label>
                        <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="{{ $rekamMedis->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Pasien:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekamMedis->pasien->Nama }}" readonly>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="form-group">
                            <label for="Tanggal_lahir">Tanggal Lahir:</label>
                            <input type="text" class="form-control" id="Tanggal_lahir" name="Tanggal_lahir" value="{{ $rekamMedis->pasien->Tanggal_lahir }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="umur">Umur:</label>
                            @php
                                $birthDate = new DateTime($rekamMedis->pasien->Tanggal_lahir);
                                $today = new DateTime('today');
                                $age = $today->diff($birthDate)->y;
                            @endphp
                            <input type="text" class="form-control" id="umur" name="umur" value="{{ $age }} tahun" readonly>
                        </div>
                    </div>
                    @php
                    $imt =  number_format($rekamMedis->berat_badan/(pow($rekamMedis->tinggi_badan / 100, 2)),1);
                    $status = '';
                    $colorClass = '';

                    if ($rekamMedis->pasien->Jenis_Kelamin == 'female') {
                        if ($imt < 17) {
                            $status = 'Underweight';
                            $colorClass = 'bg-danger';
                        } elseif ($imt >= 17 && $imt < 23) {
                            $status = 'Normal';
                            $colorClass = 'bg-success';
                        } elseif ($imt >= 23 && $imt <= 27) {
                            $status = 'Overweight';
                            $colorClass = 'bg-warning';
                        } else {
                            $status = 'Obesity';
                            $colorClass = 'bg-danger';
                        }
                    } elseif ($rekamMedis->pasien->Jenis_Kelamin == 'male') {
                        if ($imt < 18) {
                            $status = 'Underweight';
                            $colorClass = 'bg-danger';
                        } elseif ($imt >= 18 && $imt < 25) {
                            $status = 'Normal';
                            $colorClass = 'bg-success';
                        } elseif ($imt >= 25 && $imt <= 27) {
                            $status = 'Overweight';
                            $colorClass = 'bg-warning';
                        } else {
                            $status = 'Obesity';
                            $colorClass = 'bg-danger';
                        }
                    }else{
                        $status = 'Nilai tidak masuk';
                        $colorClass = 'bg-danger';
                    }
                    @endphp
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan:</label>
                            <input type="text" class="form-control" id="berat_badan" name="berat_badan" value="{{ $rekamMedis->berat_badan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan:</label>
                            <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" value="{{ $rekamMedis->tinggi_badan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="imt">IMT:</label>
                            <input type="text" class="form-control" id="imt" name="imt" value="{{  number_format($rekamMedis->berat_badan/(pow($rekamMedis->tinggi_badan / 100, 2)),1)}}" readonly>
                        </div>
                        <h2><span class="badge {{ $colorClass }} mt-4">{{ $status }}</span></h2>
                    </div>


                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $rekamMedis->tanggal }}">
                    </div>
                    <div class="form-group">
                        <label for="pemeriksaan">Pemeriksaan:</label>
                        <input type="text" class="form-control" id="pemeriksaan" name="pemeriksaan" value="{{ $rekamMedis->pemeriksaan }}">
                    </div>
                    <div class="form-group">
                        <label for="diagnosa">Diagnosa:</label>
                        <textarea class="form-control" id="diagnosa" name="diagnosa">{{ $rekamMedis->diagnosa }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="Terapi">Terapi:</label>
                        <textarea class="form-control" id="terapi" name="terapi">{{ $rekamMedis->terapi }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="tags_input" name="bmhp" value="{{ $namaLogistikDipilih }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                @if ($namaLogistikDipilih != null)
                    <div class="mt-3">
                        <h3>BMHP</h3>
                        <div id="tag-container" class="d-flex flex-wrap">
                            <!-- Tags akan ditambahkan di sini -->
                        </div>
                    </div>
                @endif

                {{-- modal --}}
                <!-- Trigger Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch Modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-size">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3>Barang Medis Habis Pakai</h3>
                        </div>
                        <div class="card-body">

                            @if($logistikAll->isEmpty())
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
                                        @foreach($logistikAll as $logistik)
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
        {{-- end of modal body --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
            </div>
            {{-- sisi kanan --}}
            <div class="col-md-6">
                <div class="mt-6">
                    <canvas id="graphCanvas" width="600" height="600" style="border:1px solid #000000;"></canvas>
                    <div id="popup" style="display:none; position:absolute; background-color:white; border:1px solid black; padding:7px; z-index:1000;">
                        <form id="popupForm">
                            <div class="mb-1">
                                <label for="popupBagianTubuhInput" class="form-label">Bagian Tubuh</label>
                                <input type="text" class="form-control" id="popupBagianTubuhInput" required>
                            </div>
                            <div class="mb-1">
                                <label for="popupKeteranganInput" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="popupKeteranganInput" required>
                            </div>
                            <input type="hidden" id="popupInputX">
                            <input type="hidden" id="popupInputY">
                            <button type="button" class="btn btn-primary" id="savePopupBtn">Simpan</button>
                            <button type="button" class="btn btn-secondary" id="closePopupBtn">Tutup</button>
                        </form>
                    </div>

                    <!-- Tabel untuk menampilkan daftar bagian tubuh -->
                <table id="yourTableId">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bagian Tubuh</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Diisi oleh JavaScript -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>







<script>

function deletePoint(id) {
        console.log(id);
    fetch(`/delete-point/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Tampilkan pesan atau lakukan sesuatu setelah data berhasil dihapus
        console.log('Data berhasil dihapus', data);

        // Refresh tabel setelah penghapusan
        loadImageAndDraw('{{ $rekamMedis->id }}');
    })
    .catch(error => {
        console.error('Terjadi kesalahan:', error);
    });
}





function loadImageAndDraw(rekam_medis_id) {
    const canvas = document.getElementById('graphCanvas');
    const ctx = canvas.getContext('2d');
    const imgSrc = "{{asset('anatomi_lk.png')}}";
    const img = new Image();
    img.src = imgSrc;
    img.onload = function() {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        // Setelah gambar dimuat, ambil data anatomi
        fetchDataAndDrawPoints(rekam_medis_id);
    };
}

async function fetchDataAndDrawPoints(rekam_medis_id) {
    try {
        const data = await getDataFromAnatomiTable(rekam_medis_id);
        console.log(data);
        let tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = ''; // Kosongkan tabel sebelum mengisi ulang
        if (data && data.length > 0) {
            data.forEach(point =>{
                drawPoint(point.x, point.y, point.keterangan)
                let row = `
                    <tr id="row-${point.id}">
                        <td>${point.id}</td>
                        <td>${point.bagian_tubuh}</td>
                        <td>${point.keterangan}</td>
                        <td>
                            <button onclick="deletePoint(${point.id})" class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                `;
            tableBody.innerHTML += row;
            } );
        } else {
            console.log("Data anatomi kosong atau tidak tersedia.");
        }
    } catch (error) {
        console.error('Kesalahan saat mengambil data:', error);
    }
}

function getDataFromAnatomiTable(rekam_medis_id) {
    return fetch(`/get-anatomi/${rekam_medis_id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => data)
    .catch(error => {
        console.error('Terjadi kesalahan:', error);
        throw error;
    });
}

// Fungsi untuk menggambar titik di kanvas
function drawPoint(x, y, keterangan) {
    const canvas = document.getElementById('graphCanvas');
    const ctx = canvas.getContext('2d');
    ctx.beginPath();
    ctx.arc(x, y, 5, 0, 2 * Math.PI);
    ctx.fillStyle = 'blue';
    ctx.fill();
    ctx.fillText(keterangan, x + 10, y + 10); // Menampilkan teks di samping titik
}



document.addEventListener("DOMContentLoaded", function() {


   console.log("DOMContentLoaded");
    loadImageAndDraw('{{ $rekamMedis->id }}');


//     getDataFromAnatomiTable('{{ $rekamMedis->id }}');



// // #####untuk menampilkan gambar anatomi
    const canvas = document.getElementById('graphCanvas');

    canvas.addEventListener('click', function(event) {
        const rect = canvas.getBoundingClientRect();
        clickX = event.clientX - rect.left;
        clickY = event.clientY - rect.top;

        // Set position of the popup relative to the canvas
        const popupX = event.clientX - rect.left;
        const popupY = event.clientY - rect.top;

        popup.style.left = `${popupX}px`;
        popup.style.top = `${popupY}px`;
        popup.style.display = 'block';

        // Set the hidden input values in the form
        document.getElementById('popupInputX').value = clickX;
        document.getElementById('popupInputY').value = clickY;
    });

    document.getElementById('savePopupBtn').addEventListener('click', function() {
        const rekam_medis_id = '{{ $rekamMedis->id }}';
        const keterangan = document.getElementById('popupKeteranganInput').value;
        const bagian_tubuh = document.getElementById('popupBagianTubuhInput').value;
        const x = document.getElementById('popupInputX').value;
        const y = document.getElementById('popupInputY').value;

        if (keterangan) {
            console.log(rekam_medis_id, keterangan, x, y, bagian_tubuh);
            // Kirim data ke server menggunakan AJAX
            fetch('/save-point', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // jika menggunakan Laravel atau framework lain yang membutuhkan CSRF token
                },
                body: JSON.stringify({rekam_medis_id: rekam_medis_id, x: x, y: y, BagianTubuh: bagian_tubuh, keterangan: keterangan })
            })
            .then(response => response.json())
            .then(data => {
                // Lakukan sesuatu setelah data berhasil disimpan, misalnya:
                console.log('Data berhasil disimpan', data);
                // drawPoint(x, y, keterangan); // Gambar titik baru di canvas
                loadImageAndDraw(rekam_medis_id); // Tambahkan baris baru ke tabel
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });

            // Sembunyikan popup
            popup.style.display = 'none';
            // Reset form
            document.getElementById('popupForm').reset();
        }
    });

    document.getElementById('closePopupBtn').addEventListener('click', function() {
        popup.style.display = 'none';
    });




// #### untuk menampilkan tag
    @if ($namaLogistikDipilih != null)
        // Hardcoded tags data
        const tagString = "{{ $namaLogistikDipilih }}";
        const tags = tagString.split(',');
        // Get the tag container
        const tagContainer = document.getElementById('tag-container');
        const tagsInput = document.getElementById('tags_input');

        function updateTagsInput() {
            // Update input hidden value with the current tags joined by a comma
            tagsInput.value = tags.join(',');
        }

        function addTag(tag) {
            const tagCard = document.createElement('div');
            tagCard.className = 'card m-2';
            tagCard.style.width = 'auto';

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body p-2 d-flex align-items-center';

            const tagText = document.createElement('span');
            tagText.className = 'mr-2';
            tagText.textContent = tag;

            const deleteIcon = document.createElement('span');
            deleteIcon.innerHTML = '&times;';
            deleteIcon.className = 'ml-2 text-danger';
            deleteIcon.style.cursor = 'pointer';
            deleteIcon.onclick = function() {
                const index = tags.indexOf(tag);
                if (index > -1) {
                    tags.splice(index, 1); // Remove tag from array
                    tagContainer.removeChild(tagCard); // Remove tag element from UI
                    updateTagsInput(); // Update the hidden input value
                }
            };

            cardBody.appendChild(tagText);
            cardBody.appendChild(deleteIcon);
            tagCard.appendChild(cardBody);
            tagContainer.appendChild(tagCard);
        }

        // Loop untuk setiap tags array dan tambahkan ke dalam container
        tags.forEach(tag => {
            addTag(tag);
        });
    @else
        console.log("Nama logistik is null or undefined.");
    @endif
});
// script untuk modal
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
                window.location.href = `/rm/{{ $rekamMedis->id }}/periksa/${encodeURIComponent(selectedItemNames)}`;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
            }



        });




    });



</script>

@endsection
