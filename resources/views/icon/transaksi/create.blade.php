@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Tambah Pengeluaran untuk: {{ $proyek->title }}</h2>
        <div class="">
        </div>
    </div>
    <div class="col-lg-6 mx-auto">
        <form method="POST" action="{{ route('icon_transaction.store', $proyek) }}" class="mb-5"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="no" class="form-label">Nomor Pengajuan</label>
                <input type="text" class="form-control @error('no') is-invalid @enderror" id="no" name="no"
                    value="{{ old('no') }}">
                @error('no')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="recipient" class="form-label">Penerima</label>
                <input type="text" class="form-control @error('recipient') is-invalid @enderror" id="recipient"
                    name="recipient" required value="{{ old('recipient') }}">
                @error('recipient')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori Pengeluaran</label>
                <select type="text" class="form-select" id="category" name="category">
                    <option value="Material" {{ old('category') == 'Material' ? 'selected' : '' }}>Biaya Material
                    </option>
                    <option value="Operasional" {{ old('category') == 'Operasional' ? 'selected' : '' }}>Biaya Operasional
                    </option>
                    <option value="Perijinan" {{ old('category') == 'Perijinan' ? 'selected' : '' }}> Biaya Perijinan
                    </option>
                    <option value="Rutin" {{ old('category') == 'Rutin' ? 'selected' : '' }}>Pengeluaran Rutin</option>
                    <option value="Gaji" {{ old('category') == 'Gaji' ? 'selected' : '' }}>Gaji</option>
                    <option value="Denda" {{ old('category') == 'Denda' ? 'selected' : '' }}>Denda</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pengeluaran</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    name="amount" required value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
                @error('date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Keterangan</label>
                <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note"
                    value="{{ old('note') }}">
                @error('note')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div id="image-input-container">
                <div class="mb-3 image-input">
                    <label for="image" class="form-label">Foto 1 (Max: 1MB)</label>
                    <img class="img-preview img-fluid mb-3 col-sm-3" style="display: none;">
                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage(this)">
                    @error('image')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" id="add-image" class="btn btn-secondary mb-2">Tambah Input Foto</button>
                    <button type="button" id="remove-image" class="btn btn-danger mb-2" style="display: none;">Hapus
                        Foto Terakhir</button>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 mb-5 px-3">Save</button>

            </div>
        </form>
    </div>

    <script>
        let imageCount = 1; // Track the number of image inputs
        const maxImages = 4; // Maximum allowed image inputs

        document.getElementById('add-image').addEventListener('click', () => {
            if (imageCount < maxImages) {
                imageCount++;

                const container = document.getElementById('image-input-container'); // Corrected id here
                const newInput = document.createElement('div');
                newInput.classList.add('mb-2', 'image-input');
                newInput.innerHTML = `
            <label for="image${imageCount}" class="form-label">Foto ${imageCount} (Max: 1MB)</label>
            <img class="img-preview img-fluid mb-3 col-sm-3" style="display: none;">
            <input class="form-control" type="file" id="image${imageCount}" name="image${imageCount}" onchange="previewImage(this)">
        `;
                container.appendChild(newInput);

                if (imageCount === maxImages) {
                    document.getElementById('add-image').style.display = 'none';
                }
                document.getElementById('remove-image').style.display =
                    'inline-block'; // Ensure remove button appears
            }
        });

        document.getElementById('remove-image').addEventListener('click', () => {
            if (imageCount > 1) {
                const container = document.getElementById('image-input-container'); // Corrected id here
                container.lastElementChild.remove();
                imageCount--;

                if (imageCount < maxImages) {
                    document.getElementById('add-image').style.display = 'inline-block';
                }
                if (imageCount === 1) {
                    document.getElementById('remove-image').style.display =
                        'none'; // Hide remove button when only 1 input remains
                }
            }
        });

        function previewImage(input) {
            const imgPreview = input.previousElementSibling;

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }
    </script>
@endsection
