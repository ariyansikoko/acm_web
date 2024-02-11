<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Project;

class ReportController extends Controller
{
    public function index()
    {
        $project = Project::where('status', 1)->get();

        return view('laporan', [
            'title' => 'ACM | Laporan',
            'project' => $project,
        ]);
    }
}
