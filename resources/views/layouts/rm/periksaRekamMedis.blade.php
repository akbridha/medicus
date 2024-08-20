@extends('header')

@section('content')
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
            <th>X</th>
            <th>Y</th>
            <th>Bagian Tubuh</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        {{-- @foreach($anatomi as $item)
            <tr id="row-{{ $item->id }}">
                <td>{{ $item->x }}</td>
                <td>{{ $item->y }}</td>
                <td>{{ $item->BagianTubuh }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <button onclick="deletePoint({{ $item->id }})">Hapus</button>
                </td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>







<script>
document.addEventListener("DOMContentLoaded", function() {
    getDataFromAnatomiTable('{{ $rekamMedis->id }}');



// #####untuk menampilkan gambar anatomi
    const canvas = document.getElementById('graphCanvas');
    const ctx = canvas.getContext('2d');
    const popup = document.getElementById('popup');


    let clickX, clickY;

    // Data titik koordinat dari backend
    let points = @json($rekamMedis->anatomi);

    // Gambar background grafik
    const img = new Image();
    img.src = "{{asset('anatomi_lk.png')}}";
    img.onload = function() {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        // Gambar ulang semua titik dengan keterangan
        if (points && points.length > 0) {
            points.forEach(point => {
                drawPoint(point.x, point.y, point.keterangan);
            });
        } else {
            console.log("Data anatomi kosong atau tidak tersedia.");
        }
    }

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
                drawPoint(x, y, keterangan); // Gambar titik baru di canvas
                getDataFromAnatomiTable(rekam_medis_id); // Tambahkan baris baru ke tabel
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

    function drawPoint(x, y, keterangan) {
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, 2 * Math.PI);
        ctx.fillStyle = 'blue';
        ctx.fill();
        ctx.fillText(keterangan, x + 10, y + 10); // Menampilkan teks di samping titik
    }

        function deletePoint(id) {
            console.log(id);
        // fetch(`/delete-point/${id}`, {
        //     method: 'DELETE',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     }
        // })
        // .then(response => response.json())
        // .then(data => {
        //     // Tampilkan pesan atau lakukan sesuatu setelah data berhasil dihapus
        //     console.log('Data berhasil dihapus', data);

        //     // Refresh tabel setelah penghapusan
        //     updateTable();
        // })
        // .catch(error => {
        //     console.error('Terjadi kesalahan:', error);
        // });
    }

    function renderTable(data) {
        let tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = ''; // Kosongkan tabel sebelum mengisi ulang

        data.forEach(item => {
            let row = `
                <tr id="row-${item.id}">
                    <td>${item.x}</td>
                    <td>${item.y}</td>
                    <td>${item.BagianTubuh}</td>
                    <td>${item.keterangan}</td>
                    <td>
                        <button onclick="deletePoint(${item.id})" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    function getDataFromAnatomiTable(rekam_medis_id){
        fetch(`/get-anatomi/${rekam_medis_id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Panggil fungsi untuk me-render data di Blade
            renderTable(data);
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
    }




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
