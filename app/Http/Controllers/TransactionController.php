<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaksi', [
            'title' => 'ACM | Transaksi',
            'transaksi' => Transaction::orderBy('transaction_date', 'desc')->get(),
        ]);
    }
}
