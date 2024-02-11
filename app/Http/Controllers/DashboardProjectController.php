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
        $project = Project::latest()->get();
        return view('dashboard.proyek.index', [
            'project' => $project,
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
            'project_id' => 'required|unique:projects|size:8',
            'client' => 'required',
            'project_date' => 'required|date',
            'episode' => 'required',
            'location' => 'required',
            'type' => 'required',
            'title' => 'required',
            'boq_plan' => 'nullable|numeric|integer',
            'boq_actual' => 'nullable|numeric|integer',
            'comcase' => 'nullable|numeric|integer',
            'boq_subcon' => 'nullable|numeric|integer',
            'boq_desc' => 'max:255',
            'no_po' => 'nullable|integer',
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
            'boq_plan' => 'nullable|numeric|integer',
            'boq_actual' => 'nullable|numeric|integer',
            'comcase' => 'nullable|numeric|integer',
            'boq_subcon' => 'nullable|numeric|integer',
            'boq_desc' => 'max:255',
            'no_po' => 'nullable|integer',
            'status' => 'required|boolean',
            'close_date' => 'required|date',
        ];

        if ($request->project_id != $proyek->project_id) {
            $rules['project_id'] = 'required|unique:projects|digits:8';
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
