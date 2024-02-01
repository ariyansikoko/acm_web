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
        $title = '';
        if (request('project')) {
            $project = Project::firstWhere('slug', request('project'));
            $title = ': ' . $project->title;
        }
        if (request('recipient')) {
            $recipient = Recipient::firstWhere('slug', request('recipient'));
            $title = ' oleh ' . $recipient->name;
        }

        return view('transaksi', [
            'title' => 'Data Pengeluaran Proyek' . $title,
            'transaksi' => Transaction::latest()->filter(request(['search', 'project', 'recipient']))->paginate(20)->withQueryString(),
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
