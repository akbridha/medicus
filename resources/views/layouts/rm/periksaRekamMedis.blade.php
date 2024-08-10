@extends('header')

@section('content')
<div class="container">
    <h2>Tindakan</h2>

    <div class="col-md-4 mt-4">
        <a href="{{route('logistik.tx', $rekamMedis->id )}}" class="text-decoration-none text-dark" >
            <div class="card bg-primary text-white">
                <div class="card-body">

                    <h5 class="card-title">
                        <img src="{{asset('Icons/round-arrow.svg')}}" alt="round-arrow" width="28" height="24">
                        TX Logistik

                    </h5>
                    <p class="card-text">Transaksi</p>
                </div>
            </a>
        </div>
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
    <div class="container mt-3">
        <h3>BMHP</h3>
        <div id="tag-container" class="d-flex flex-wrap">
            <!-- Tags will be appended here -->
        </div>
    </div>
@endif


<script>
document.addEventListener("DOMContentLoaded", function() {
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

        // Loop tuk setiap tags array dan tambah ke dalam container
        tags.forEach(tag => {
            addTag(tag);
        });
    @else
        console.log("Nama logistik is null or undefined.");
    @endif


});

</script>

</div>
@endsection
