@extends('header')

@section('content')
<style>
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
                        <input type="hidden" id="tags_input" name="bmhp" value="{{ $namaLogistik }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                @if ($namaLogistik != null)
                    <div class="mt-3">
                        <h3>BMHP</h3>
                        <div id="tag-container" class="d-flex flex-wrap">
                            <!-- Tags akan ditambahkan di sini -->
                        </div>
                    </div>
                @endif
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
    @if ($namaLogistik != null)
        // Hardcoded tags data
        const tagString = "{{ $namaLogistik }}";
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

</script>

@endsection
