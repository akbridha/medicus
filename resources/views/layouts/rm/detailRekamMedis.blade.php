@extends('header')

@section('content')
    <div class="container-fluid" style="width: 90%;">
        <div class="row">
            <div class="col-md-6"> <!-- Menggunakan setengah lebar -->
                <!-- Konten kolom kiri -->
                <h2>Detail Rekam Medis</h2>
                {{-- <div class="mt-4">
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
                </div> --}}
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
                        <input type="hidden" id="tags_input" name="bmhp" value="{{ $rekamMedis->BMHP }}">
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                </form>
                @if ($rekamMedis->BMHP != null)
                    <div class="mt-3">
                        <h3>BMHP</h3>
                        <div id="tag-container" class="d-flex flex-wrap">
                            <!-- Tags akan ditambahkan di sini -->
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="mt-6">
                    <canvas id="graphCanvas" width="800" height="800" style="border:1px solid #000000;"></canvas>
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
                </div>
            </div>
        </div>
    </div>







<script>
    document.addEventListener("DOMContentLoaded", function() {

        const canvas = document.getElementById('graphCanvas');
        const ctx = canvas.getContext('2d');
        const popup = document.getElementById('popup');

//   #########untuk keperluan gambar anatomi

        let clickX, clickY;

        // Data titik koordinat dari backend
        let points = @json($rekamMedis->anatomi);  // pastikan $titik juga berisi keterangan

        // Gambar background grafik
        const img = new Image();
        img.src = "{{asset('anatomi_lk.png')}}";
        img.onload = function() {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            // Gambar ulang semua titik dengan keterangan
            points.forEach(point => {
                drawPoint(point.x, point.y, point.keterangan);
            });
        }


        function drawPoint(x, y, keterangan) {
            ctx.beginPath();
            ctx.arc(x, y, 5, 0, 2 * Math.PI);
            ctx.fillStyle = 'blue';
            ctx.fill();
            ctx.fillText(keterangan, x + 10, y + 10); // Menampilkan teks di samping titik
        }


// ###########untuk menampilkan tag BMHP



 @if ($rekamMedis->BMHP != null)

        const tagString = "{{ $rekamMedis->BMHP }}";
        const tags = tagString.split(',');

        // Get the tag container
        const tagContainer = document.getElementById('tag-container');

        // Loop untuk setiap tag dalam array dan tambahkan ke dalam container
        tags.forEach(tag => {
            const tagCard = document.createElement('div');
            tagCard.className = 'card m-2';
            tagCard.style.width = 'auto';

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body p-2 d-flex align-items-center';

            const tagText = document.createElement('span');
            tagText.className = 'mr-2';
            tagText.textContent = tag;

            cardBody.appendChild(tagText);
            tagCard.appendChild(cardBody);
            tagContainer.appendChild(tagCard);
        });

        @else
            console.log("Nama logistik is null or undefined.");
        @endif






    });
</script>

@endsection
