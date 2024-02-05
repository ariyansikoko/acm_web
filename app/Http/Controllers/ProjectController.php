<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Expensetype;
use App\Models\Transaction;
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
            'project' => Project::all(),
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
        ]);
    }
}
