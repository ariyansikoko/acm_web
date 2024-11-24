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
            'recipient' => 'nullable',
            'category' => 'required',
            'no' => 'required|unique:icon_transactions',
            'note' => 'nullable',
            'date' => 'nullable|date',
            'image' => 'nullable|image|file|max:1024',
            'image2' => 'nullable|image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('/icon/bukti_pengeluaran');
        }
        if ($request->file('image2')) {
            $validated['image2'] = $request->file('image2')->store('/icon/bukti_pengeluaran');
        }

        $transaksi = new IconTransaction([
            'amount' => $validated['amount'],
            'recipient' => $validated['recipient'],
            'category' => $validated['category'],
            'no' => $validated['no'],
            'date' => $validated['date'],
            'note' => $validated['note'],
            'image' => $validated['image'] ?? null,
            'image2' => $validated['image2'] ?? null,
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
    public function edit(IconProject $proyek, IconTransaction $transaksi)
    {
        return view('icon.transaksi.edit', compact('proyek', 'transaksi'), [
            'title' => 'ACM | Edit Pengeluaran',
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IconProject $proyek, IconTransaction $transaksi)
    {
        $rules = [
            'amount' => 'required',
            'recipient' => 'nullable',
            'category' => 'required',
            'no' => 'required|unique:icon_transactions,no,' . $transaksi->id,
            'note' => 'nullable',
            'date' => 'nullable|date',
        ];

        if ($request->hasFile('image')) {
            if ($transaksi->image) {
                Storage::delete($transaksi->image);
            }
            $rules['image'] = 'nullable|image|file|max:1024';  // Validate if a new image is uploaded
        }

        if ($request->hasFile('image2')) {
            if ($transaksi->image2) {
                Storage::delete($transaksi->image2);
            }
            $rules['image2'] = 'nullable|image|file|max:1024';  // Validate if a new image2 is uploaded
        }

        $validated = $request->validate($rules);  // Apply dynamic validation rules

        // Update the transaction data
        $transaksi->update([
            'amount' => $validated['amount'],
            'recipient' => $validated['recipient'],
            'category' => $validated['category'],
            'no' => $validated['no'],
            'date' => $validated['date'],
            'note' => $validated['note'],
            'image' => $request->hasFile('image') ? $request->file('image')->store('/icon/bukti_pengeluaran') : $transaksi->image,  // Only update image if a new one is uploaded
            'image2' => $request->hasFile('image2') ? $request->file('image2')->store('/icon/bukti_pengeluaran') : $transaksi->image2,  // Only update image2 if a new one is uploaded
        ]);

        return redirect('icon/proyek/' . $proyek->id . '/transaksi/' . $transaksi->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IconProject $proyek, IconTransaction $transaksi)
    {
        if ($transaksi->image) {
            Storage::delete($transaksi->image);
        }
        if ($transaksi->image2) {
            Storage::delete($transaksi->image2);
        }

        IconTransaction::destroy($transaksi->id);
        return redirect('icon/proyek/' . $proyek->id)->with('success', 'Data berhasil dihapus.');
    }
}
