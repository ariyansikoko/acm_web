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
        $projects = Project::where('status', 1)->get();
        $ids = $projects->pluck('id');

        return view('transaksi', [
            'title' => 'ACM | Transaksi',
            'transaksi' => Transaction::whereIn('project_id', $ids)->orderBy('transaction_date', 'desc')->get(),
            // 'transaksi' => Transaction::orderBy('transaction_date', 'desc')->take(1000)->get(),
            'projects' => $projects,
            'recipients' => Recipient::where('isActive', 1)->get(),
            'expensetypes' => Expensetype::orderBy('cost_id')->get(),
        ]);
    }
}
