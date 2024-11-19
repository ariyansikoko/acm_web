<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\IconProject;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function indexTA()
    {
        $project = Project::where('boq_desc', "Sudah nilai rekon")->get();

        return view('laporan', [
            'title' => 'ACM | Laporan',
            'project' => $project,
        ]);
    }

    public function indexIcon()
    {
        $project = IconProject::all();

        return view('laporan_icon', [
            'title' => 'ACM | Laporan',
            'project' => $project,
        ]);
    }
}
