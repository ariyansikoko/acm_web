<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Project;

class ReportController extends Controller
{
    public function index()
    {
        $project = Project::where('boq_desc', "Sudah nilai rekon")->get();

        return view('laporan', [
            'title' => 'ACM | Laporan',
            'project' => $project,
        ]);
    }
}
