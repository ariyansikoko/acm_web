<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Project;

class ReportController extends Controller
{
    public function index()
    {
        $project = Project::where('status', 1)->get();
        $project_ids = $project->pluck('id')->toArray();
        $transaction = Transaction::whereIn('project_id', $project_ids)->get();

        $total_boq_plan = $project->where('boq_actual', 0)->sum('boq_plan');
        $total_boq_aktual = $project->where('boq_actual', '>', 0)->sum('boq_actual');

        $total_boq = $total_boq_plan + $total_boq_aktual;
        $total_pengeluaran = $transaction->sum('amount');

        return view('laporan', [
            'title' => 'ACM | Laporan',
            'project' => $project,
            'transaction' => $transaction,
            'total_boq' => $total_boq,
            'total_pengeluaran' => $total_pengeluaran,
        ]);
    }
}
