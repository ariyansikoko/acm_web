@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Edit Pengeluaran</h2>
        <div class="">
        </div>
    </div>
    <div class="col-lg-6 mx-auto">
        <form method="POST" action="{{ route('icon_transaction.update', ['proyek' => $proyek, 'transaksi' => $transaksi]) }}"
            class="mb-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="no" class="form-label">Nomor Pengajuan</label>
                <input type="text" class="form-control @error('no') is-invalid @enderror" id="no" name="no"
                    value="{{ old('no', $transaksi->no) }}">
                @error('no')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="recipient" class="form-label">Penerima</label>
                <input type="text" class="form-control @error('recipient') is-invalid @enderror" id="recipient"
                    name="recipient" value="{{ old('recipient', $transaksi->recipient) }}" required>
                @error('recipient')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori Pengeluaran</label>
                <select type="text" class="form-select" id="category" name="category">
                    <option value="Material" {{ old('category', $transaksi->category) == 'Material' ? 'selected' : '' }}>
                        Biaya Material
                    </option>
                    <option value="Operasional"
                        {{ old('category', $transaksi->category) == 'Operasional' ? 'selected' : '' }}>Biaya Operasional
                    </option>
                    <option value="Perijinan" {{ old('category', $transaksi->category) == 'Perijinan' ? 'selected' : '' }}>
                        Biaya Perijinan
                    </option>
                    <option value="Rutin" {{ old('category', $transaksi->category) == 'Rutin' ? 'selected' : '' }}>
                        Pengeluaran Rutin</option>
                    <option value="Gaji" {{ old('category', $transaksi->category) == 'Gaji' ? 'selected' : '' }}>Gaji
                    </option>
                    <option value="Denda" {{ old('category', $transaksi->category) == 'Denda' ? 'selected' : '' }}>Denda
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pengeluaran</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    name="amount" value="{{ old('amount', $transaksi->amount) }}" required>
                @error('amount')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date"
                    value="{{ old('date', $transaksi->date) }}">
                @error('date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Keterangan</label>
                <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note"
                    value="{{ old('note', $transaksi->note) }}">
                @error('note')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Foto 1 (Max: 1MB)</label>
                <input type="hidden" name="image" value="{{ $transaksi->image }}">
                @if ($transaksi->image)
                    <img src="{{ asset('storage/' . $transaksi->image) }}" id="image"
                        class="img-fluid mb-3 col-sm-3 d-block">
                @else
                    <img id="image" class="img-fluid mb-3 col-sm-3" style="display: none;">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage(this)">
                @error('image')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image2" class="form-label">Foto 2 (Max: 1MB)</label>
                <input type="hidden" name="image2" value="{{ $transaksi->image2 }}">
                @if ($transaksi->image2)
                    <img src="{{ asset('storage/' . $transaksi->image2) }}" id="image2"
                        class="img-fluid mb-3 col-sm-3 d-block">
                @else
                    <img id="image2" class="img-fluid mb-3 col-sm-3" style="display: none;">
                @endif
                <input class="form-control @error('image2') is-invalid @enderror" type="file" id="image2"
                    name="image2" onchange="previewImage(this)">
                @error('image2')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image3" class="form-label">Foto 3 (Max: 1MB)</label>
                <input type="hidden" name="image3" value="{{ $transaksi->image3 }}">
                @if ($transaksi->image3)
                    <img src="{{ asset('storage/' . $transaksi->image3) }}" id="image3"
                        class="img-fluid mb-3 col-sm-3 d-block">
                @else
                    <img id="image3" class="img-fluid mb-3 col-sm-3" style="display: none;">
                @endif
                <input class="form-control @error('image3') is-invalid @enderror" type="file" id="image3"
                    name="image3" onchange="previewImage(this)">
                @error('image3')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image4" class="form-label">Foto 4 (Max: 1MB)</label>
                <input type="hidden" name="image4" value="{{ $transaksi->image4 }}">
                @if ($transaksi->image4)
                    <img src="{{ asset('storage/' . $transaksi->image4) }}" id="image4"
                        class="img-fluid mb-3 col-sm-3 d-block">
                @else
                    <img id="image4" class="img-fluid mb-3 col-sm-3" style="display: none;">
                @endif
                <input class="form-control @error('image4') is-invalid @enderror" type="file" id="image4"
                    name="image4" onchange="previewImage(this)">
                @error('image4')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mb-5">Update</button>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const imgPreview = input.previousElementSibling;

            if (input.files && input.files[0]) {
                imgPreview.style.display = 'block';

                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
