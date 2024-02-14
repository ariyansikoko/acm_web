<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Expensetype;
use App\Models\Recipient;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proyek', [
            'title' => 'ACM | Projek',
            'project' => Project::orderBy('project_date', 'desc')->get(),
        ]);
    }

    public function summary(Project $project)
    {
        $transaction = Transaction::where('project_id', $project->id)->get();
        $projectall = Project::where('episode', $project->episode)->get();
        $totalbiaya = Transaction::where('project_id', $project->id)->where('category', 'Biaya Perusahaan')->sum('amount');
        $totalsubcon = Transaction::where('project_id', $project->id)->where('category', 'DP Subcon')->sum('amount');

        $dpsubcon = ['B Upah Tukang', 'B Upah KU', 'B Upah & Honorer', 'B Penyambungan'];

        $episode = $project->episode;

        $totalAmount = DB::table('transactions')
            ->join('projects', 'transactions.project_id', '=', 'projects.id')
            ->where('projects.episode', $episode)
            ->sum('transactions.amount');

        return view('summary', [
            'title' => 'ACM | Summary',
            'header' => 'Nama Proyek: ' . $project->title,
            'transaction' => $transaction,
            'type' => Expensetype::all(),
            'totalbp' => $totalbiaya,
            'totaldp' => $totalsubcon,
            'filter' => $dpsubcon,
            'episode' => $episode,
            'projectall' => $projectall,
            'project' => $project,
            'totalamount' => $totalAmount,
            'recipients' => Recipient::where('isActive', 1)->get(),
            'expensetypes' => Expensetype::orderBy('cost_id')->get(),
        ]);
    }

    public function storeTransaction(Request $request)
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

        return redirect()->back()->with('success', 'Transaksi untuk proyek ini berhasil ditambahkan.');
    }
}
