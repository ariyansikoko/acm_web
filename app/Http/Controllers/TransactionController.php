<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Transaction;
use App\Models\Recipient;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaksi', [
            'title' => 'ACM | Transaksi',
            'transaksi' => Transaction::latest()->get(),
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('show', [
            'title' => 'Details',
            'transaksi' => $transaction,
        ]);
    }
}
