<?php

namespace App\Http\Controllers;

use App\Models\IconProject;
use Illuminate\Http\Request;
use App\Models\IconTransaction;
use Illuminate\Support\Facades\Storage;

class IconTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(IconProject $proyek)
    {
        return view('icon.transaksi.create', compact('proyek'), [
            'title' => 'ACM | Tambah Pengeluaran',
            'projects' => IconProject::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, IconProject $proyek)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'no' => 'required|unique:icon_transactions',
            'image' => 'nullable|image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('/icon/bukti_pengeluaran');
        }

        $transaksi = new IconTransaction([
            'amount' => $validated['amount'],
            'no' => $validated['no'],
            'image' => $validated['image'] ?? null,
        ]);

        $proyek->iconTransaction()->save($transaksi);

        return redirect('icon/proyek/' . $proyek->id)->with('success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(IconProject $proyek, IconTransaction $transaksi)
    {
        return view('icon.transaksi.show', compact('proyek', 'transaksi'), [
            'title' => 'ACM | Detail Pengeluaran',
            'transaction' => $transaksi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IconTransaction $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IconTransaction $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IconProject $proyek, IconTransaction $transaksi)
    {
        if ($transaksi->image_self) {
            Storage::delete($transaksi->image);
        }

        IconTransaction::destroy($transaksi->id);
        return redirect('icon/proyek/' . $proyek->id)->with('success', 'Data berhasil dihapus.');
    }
}
