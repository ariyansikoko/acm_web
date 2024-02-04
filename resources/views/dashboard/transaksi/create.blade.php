@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Data Pengeluaran Baru</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/pengeluaran" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="project_id" class="form-label">Nama Proyek</label>
                <select class="form-select" name="project_id" id="project_id">
                    @foreach ($projects as $project)
                        @if (old('project_id') == $project->id)
                            <option value="{{ $project->id }}" selected>{{ $project->project_id }} - {{ $project->title }}
                            </option>
                        @else
                            <option value="{{ $project->id }}">{{ $project->project_id }} - {{ $project->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="recipient_id" class="form-label">Penerima</label>
                <select class="form-select" name="recipient_id">
                    @foreach ($recipients as $item)
                        @if (old('recipient_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="transaction_date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="transaction_date" name="transaction_date"
                    value="{{ old('transaction_date') }}">
                @error('transaction_date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Pengeluaran/Debit</label>
                <input type="text" class="form-control" @error('amount') is-invalid @enderror id="amount"
                    name="amount" required value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori Biaya</label>
                <input type="text" class="form-control" @error('category') is-invalid @enderror id="category"
                    name="category" required value="{{ old('category') }}">
                @error('category')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="expensetype_id" class="form-label">Jenis Biaya</label>
                <select class="form-select" name="expensetype_id">
                    @foreach ($expensetypes as $item)
                        @if (old('expensetype_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->cost_id }} - {{ $item->name }}
                            </option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->cost_id }} - {{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ old('description') }}">
            </div>
            <button type="submit" class="btn btn-primary">Selesai</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            // Use Select2 for the project_id select element
            $('#project_id').select2({
                placeholder: 'Search for a project...',
                allowClear: false,
                theme: "bootstrap4",
            });
        });
    </script>
@endsection
