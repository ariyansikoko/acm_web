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
                <input type="text" class="form-control @error('category') is-invalid @enderror" id="category"
                    name="category" required value="{{ old('category') }}">
                @error('category')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pengeluaran</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    name="amount" required value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="form-label">Foto (Max: 1MB)</label>
                <img class="img-preview img-fluid mb-3 col-sm-3">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage()">
                @error('image')
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
    </script>
@endsection
