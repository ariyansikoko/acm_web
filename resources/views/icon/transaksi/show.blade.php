@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Detail Pengeluaran</h2>
        <div class="">
            <a href="{{ route('icon_transaction.edit', ['proyek' => $transaction->iconproject->id, 'transaksi' => $transaction->id]) }}"
                class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
            <form
                action="{{ route('icon_transaction.destroy', ['proyek' => $transaction->iconproject->id, 'transaksi' => $transaction->id]) }}"
                method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus?')">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show mx-auto" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-md-7 mx-auto mt-5">
        <table class="table table-striped-columns table-bordered border-dark">
            <tr>
                <td>Tanggal</td>
                <td>
                    @if ($transaksi->date)
                        {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td>Nomor Pengajuan</td>
                <td>{{ $transaksi->no }}</td>
            </tr>
            <tr>
                <td>Penerima</td>
                <td>{{ $transaksi->recipient }}</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>{{ $transaksi->category }}</td>
            </tr>
            <tr>
                <td>Jumlah Pengeluaran</td>
                <td>{{ formatRupiah($transaksi->amount) }}</td>
            </tr>
            @if ($transaksi->note)
                <tr>
                    <td>Kategori</td>
                    <td>{{ $transaksi->note }}</td>
                </tr>
            @endif
            @if ($transaksi->image)
                <tr class="text-center">
                    <td colspan="2">
                        <h5>Foto 1</h5>
                        <img src="{{ asset('storage/' . $transaksi->image) }}" style="max-height: 300px; width: auto">
                    </td>
                </tr>
            @endif
            @if ($transaksi->image2)
                <tr class="text-center">
                    <td colspan="2">
                        <h5>Foto 2</h5>
                        <img src="{{ asset('storage/' . $transaksi->image2) }}" style="max-height: 300px; width: auto">
                    </td>
                </tr>
            @endif
            @if ($transaksi->image3)
                <tr class="text-center">
                    <td colspan="2">
                        <h5>Foto 3</h5>
                        <img src="{{ asset('storage/' . $transaksi->image3) }}" style="max-height: 300px; width: auto">
                    </td>
                </tr>
            @endif
            @if ($transaksi->image4)
                <tr class="text-center">
                    <td colspan="2">
                        <h5>Foto 2</h5>
                        <img src="{{ asset('storage/' . $transaksi->image4) }}" style="max-height: 300px; width: auto">
                    </td>
                </tr>
            @endif
        </table>
    </div>
@endsection
