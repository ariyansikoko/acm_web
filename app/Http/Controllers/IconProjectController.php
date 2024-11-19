<?php

namespace App\Http\Controllers;

use App\Models\IconProject;
use Illuminate\Http\Request;
use App\Models\IconTransaction;

class IconProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('icon.proyek.index', [
            "title" => 'ACM | Icon',
            'projects' => IconProject::with('iconTransaction')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('icon.proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'location' => 'required',
            'project_date' => 'date|nullable',
            'no_pa' => 'required|unique:icon_projects',
            'pkb_initial' => 'nullable|numeric|integer',
            'pkb_final' => 'nullable|numeric|integer',
            'boq_desc' => 'max:255|nullable',
        ]);

        IconProject::create($validated);
        return redirect('icon/proyek')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(IconProject $proyek)
    {
        $totalexpense = $proyek->iconTransaction()->sum('amount');
        return view('icon.proyek.show', [
            'title' => 'ACM | Detail Pekerjaan',
            'project' => $proyek,
            'transactions' => $proyek->iconTransaction()->get(),
            'totalexpense' => $totalexpense,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IconProject $proyek)
    {
        return view('icon.proyek.edit', [
            'title' => 'ACM | Edit Pekerjaan',
            'project' => $proyek,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IconProject $proyek)
    {
        $rules = [
            'project_id' => 'required',
            'title' => 'required',
            'location' => 'required',
            'project_date' => 'nullable|date',
            'no_pa' => 'required',
            'pkb_initial' => 'nullable|numeric|integer',
            'pkb_final' => 'nullable|numeric|integer',
            'note' => 'max:255|nullable',
        ];

        $validated = $request->validate($rules);

        IconProject::where('id', $proyek->id)
            ->update($validated);

        return redirect('icon/proyek')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IconProject $proyek)
    {
        if ($proyek->iconTransaction()->count() > 0) {
            return redirect('icon/proyek')->with('failed', 'Ada transaksi yang terhubung pada proyek ini.');
        }
        IconProject::destroy($proyek->id);
        return redirect('icon/proyek')->with('success', 'Data berhasil dihapus.');
    }
}
