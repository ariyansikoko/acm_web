@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Detail Pengeluaran</h2>
        <div class="">
            <form
                action="{{ route('icon_transaction.destroy', ['proyek' => $transaction->iconproject->id, 'transaksi' => $transaction->id]) }}"
                method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-6 mx-auto mt-5">
        <table class="table table-striped-columns table-bordered border-dark">
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
                <td>{{ $transaksi->amount }}</td>
            </tr>
            @if ($transaksi->image)
                <tr class="text-center">
                    <td colspan="2">
                        <h5>Foto</h5>
                        <img src="{{ asset('storage/' . $transaksi->image) }}" alt="{{ $transaksi->no }}"
                            style="max-height: 300px; width: auto">
                    </td>
                </tr>
            @endif
        </table>
    </div>
@endsection
