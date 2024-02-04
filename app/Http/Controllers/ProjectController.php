<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proyek', [
            'title' => 'ACM | Projek',
            'project' => Project::latest()->get(),
        ]);
    }

    public function detail(Project $project)
    {
        return view('detail', [
            'title' => 'Project Details',
            'project' => $project,
        ]);
    }
}
