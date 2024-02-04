<?php

namespace App\Http\Controllers;

use App\Models\Expensetype;
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
        $project = Project::orderBy('title')->get();
        $recipient = Recipient::orderBy('name')->get();
        $expensetype = Expensetype::orderBy('cost_id')->get();

        return view('dashboard.transaksi.create', [
            'projects' => $project,
            'recipients' => $recipient,
            'expensetypes' => $expensetype,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required',
            'recipient_id' => 'required',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|integer',
            'category' => 'required',
            'expensetype_id' => 'required',
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
            'expensetypes' => Expensetype::all(),
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
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|integer',
            'category' => 'required',
            'expensetype_id' => 'required',
            'description' => 'required',
        ];

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
