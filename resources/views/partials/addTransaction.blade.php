<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">
                <!-- Your form for adding new data goes here -->
                <form action="/proyek/{{ $project->project_id }}/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Add your form fields here -->
                    <div class="mb-3">
                        <label for="project_id" class="form-label">Nama Proyek</label>
                        <select class="form-select" name="project_id">
                            <option value="{{ $project->id }}" selected>
                                {{ $project->project_id . ' - ' . $project->title }}</option>
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
                        <input type="text" class="form-control" @error('category') is-invalid @enderror
                            id="category" name="category" required value="{{ old('category') }}">
                        @error('category')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="expensetype_id" class="form-label">Jenis Biaya</label>
                        <select class="form-select" name="expensetype_id">
                            @foreach ($expensetypes as $item)
                                @if (old('expensetype_id') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->cost_id }} -
                                        {{ $item->name }}
                                    </option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->cost_id }} - {{ $item->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
