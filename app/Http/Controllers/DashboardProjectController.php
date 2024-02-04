<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.proyek.index', [
            'project' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|unique:projects',
            'project_date' => 'required|date',
            'episode' => 'required',
            'location' => 'required',
            'type' => 'required',
            'title' => 'required',
            'boq_plan' => 'numeric|integer',
            'boq_actual' => 'numeric|integer',
            'comcase' => 'numeric|integer',
            'boq_subcon' => 'numeric|integer',
            'boq_desc' => 'max:255',
        ]);

        Project::create($validated);
        return redirect('dashboard/proyek')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $proyek)
    {
        return view('dashboard.proyek.show', [
            'project' => $proyek,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $proyek)
    {
        return view('dashboard.proyek.edit', [
            'project' => $proyek,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $proyek)
    {
        $rules = [
            'project_date' => 'required|date',
            'episode' => 'required',
            'location' => 'required',
            'type' => 'required',
            'title' => 'required',
            'boq_plan' => 'numeric|integer',
            'boq_actual' => 'numeric|integer',
            'comcase' => 'numeric|integer',
            'boq_subcon' => 'numeric|integer',
            'boq_desc' => 'max:255',
        ];

        if ($request->project_id != $proyek->project_id) {
            $rules['project_id'] = 'required|unique:projects|digits:5';
        }

        $validated = $request->validate($rules);

        Project::where('id', $proyek->id)
            ->update($validated);

        return redirect('dashboard/proyek')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $proyek)
    {
        if ($proyek->transaction()->count() > 0) {
            return redirect('dashboard/proyek')->with('failed', 'Ada transaksi yang terhubung pada proyek ini.');
        }
        Project::destroy($proyek->id);
        return redirect('dashboard/proyek')->with('success', 'Data berhasil dihapus.');
    }
}
