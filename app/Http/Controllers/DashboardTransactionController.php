<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Project;
use App\Models\Recipient;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transaksi.index', [
            'transaksi' => Transaction::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaksi.create', [
            'projects' => Project::all(),
            'recipients' => Recipient::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_id' => 'required|unique:transactions',
            'project_id' => 'required',
            'recipient_id' => 'required',
            'requested_at' => 'required|date',
            'amount' => 'required|numeric|integer',
            'category' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        Transaction::create($validated);
        return redirect('dashboard/pengeluaran')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $pengeluaran)
    {
        return view('dashboard.transaksi.show', [
            'transaksi' => $pengeluaran,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $pengeluaran)
    {
        return view('dashboard.transaksi.edit', [
            'transaksi' => $pengeluaran,
            'projects' => Project::all(),
            'recipients' => Recipient::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $pengeluaran)
    {
        $rules = [
            'project_id' => 'required',
            'recipient_id' => 'required',
            'requested_at' => 'required|date',
            'amount' => 'required|numeric|integer',
            'category' => 'required',
            'type' => 'required',
            'description' => 'required',
        ];

        if ($request->expense_id != $pengeluaran->expense_id) {
            $rules['requested_at'] = 'required|unique:transactions|digits:5';
        }

        $validated = $request->validate($rules);

        Transaction::where('id', $pengeluaran->id)
            ->update($validated);

        return redirect('dashboard/pengeluaran')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $pengeluaran)
    {
        Transaction::destroy($pengeluaran->id);
        return redirect('dashboard/pengeluaran')->with('success', 'Data berhasil dihapus.');
    }
}
