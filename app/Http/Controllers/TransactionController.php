<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Recipient;
use App\Models\Expensetype;
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
            'projects' => Project::where('status', 1)->get(),
            'recipients' => Recipient::where('isActive', 1)->get(),
            'expensetypes' => Expensetype::orderBy('cost_id')->get(),
        ]);
    }
}
