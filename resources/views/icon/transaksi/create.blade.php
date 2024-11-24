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
            <div class="mb-4">
                <label for="image" class="form-label">Foto 1 (Max: 1MB)</label>
                <img class="img-preview img-fluid mb-3 col-sm-3">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage()">
                @error('image')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image2" class="form-label">Foto 2 (Max: 1MB)</label>
                <img class="img-preview2 img-fluid mb-3 col-sm-3">
                <input class="form-control @error('image2') is-invalid @enderror" type="file" id="image2"
                    name="image2" onchange="previewImage2()">
                @error('image2')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-5">Save</button>
        </form>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImage2() {
            const image2 = document.querySelector('#image2');
            const imgPreview2 = document.querySelector('.img-preview2');

            imgPreview2.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image2.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview2.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
