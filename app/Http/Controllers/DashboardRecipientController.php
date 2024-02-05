<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class DashboardRecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipient = Recipient::orderBy('name')->get();
        return view('dashboard.penerima.index', [
            'recipient' => $recipient,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.penerima.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:recipients',
        ]);

        Recipient::create($validated);
        return redirect('dashboard/penerima')->with('success', 'Data Penerima berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipient $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipient $penerima)
    {
        return view('dashboard.penerima.edit', [
            'recipient' => $penerima,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipient $penerima)
    {
        $rules = [
            'isActive' => 'required|boolean',
            'name' => 'required'
        ];

        $validated = $request->validate($rules);

        Recipient::where('id', $penerima->id)
            ->update($validated);

        return redirect('dashboard/penerima')->with('success', 'Data penerima berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipient $penerima)
    {
        if ($penerima->transaction()->count() > 0) {
            return redirect('dashboard/penerima')->with('failed', 'Ada transaksi yang terhubung pada penerima ini.');
        }
        Recipient::destroy($penerima->id);
        return redirect('dashboard/penerima')->with('success', 'Data penerima berhasil dihapus.');
    }
}
