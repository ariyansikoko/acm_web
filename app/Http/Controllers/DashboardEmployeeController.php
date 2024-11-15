<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.karyawan.index', [
            'employee' => Employee::where('quit_status', 'Aktif')->orderBy('name', 'asc')->get(),
        ]);
    }

    public function quit()
    {
        $quit = ['PHK', 'MD'];
        return view('dashboard.karyawan.quit', [
            'employee' => Employee::whereIn('quit_status', $quit)->orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.karyawan.create', [
            'positions' => Position::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'nullable|unique:employees|size:6',
            'name' => 'required|max:255',
            'birth_date' => 'required|date',
            'department' => 'required',
            'position_id' => 'required',
            'work_location' => 'required',
            'ptkp_status' => 'required',
            'image_self' => 'nullable|image|file|max:1024',
            'image_ktp' => 'nullable|image|file|max:1024',
            'start_date' => 'required|date',
            'address' => 'required',
            'phone_number' => 'nullable',
            'salary' => 'nullable|numeric',
            'bank_name' => 'nullable',
            'account_number' => 'nullable|numeric',
            'ktp_number' => 'required|numeric|digits:16',
            'bpjs' => 'nullable|numeric|digits:11',
            'npwp' => 'nullable',
            'blood_type' => 'required',
            'emergency_contact' => 'nullable',
            'emergency_number' => 'nullable',
        ]);

        if ($request->file('image_self')) {
            $validated['image_self'] = $request->file('image_self')->store('/images-pasfoto');
        }

        if ($request->file('image_ktp')) {
            $validated['image_ktp'] = $request->file('image_ktp')->store('/images-ktp');
        }

        Employee::create($validated);
        return redirect('dashboard/karyawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $karyawan)
    {
        return view('dashboard.karyawan.show', [
            'employee' => $karyawan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $karyawan)
    {
        return view('dashboard.karyawan.edit', [
            'karyawan' => $karyawan,
            'positions' => Position::all(),
        ]);
    }

    public function editStatus(Employee $karyawan)
    {
        return view('dashboard.karyawan.editStatus', [
            'karyawan' => $karyawan,
            'positions' => Position::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $karyawan)
    {
        $rules = [
            'name' => 'required|max:50',
            'birth_date' => 'required|date',
            'department' => 'required',
            'position_id' => 'required',
            'work_location' => 'required',
            'ptkp_status' => 'required',
            'image_self' => 'nullable|image|file|max:1024',
            'image_ktp' => 'nullable|image|file|max:1024',
            'start_date' => 'required|date',
            'address' => 'required',
            'phone_number' => 'nullable',
            'salary' => 'nullable|numeric',
            'bank_name' => 'nullable',
            'account_number' => 'nullable|numeric',
            'ktp_number' => 'required|numeric|digits:16',
            'bpjs' => 'nullable|numeric|digits:11',
            'npwp' => 'nullable',
            'blood_type' => 'required',
            'emergency_contact' => 'nullable',
            'emergency_number' => 'nullable',
            'quit_status' => 'required',
            'quit_date' => 'nullable|date',
        ];

        if ($request->employee_id != $karyawan->employee_id) {
            $rules['employee_id'] = 'nullable|unique:employees|digits:6';
        }

        $validated = $request->validate($rules);

        if ($request->file('image_self')) {
            if ($request->oldImagePasfoto) {
                Storage::delete($request->oldImagePasfoto);
            }
            $validated['image_self'] = $request->file('image_self')->store('/images-pasfoto');
        }

        if ($request->file('image_ktp')) {
            if ($request->oldImageKTP) {
                Storage::delete($request->oldImageKTP);
            }
            $validated['image_ktp'] = $request->file('image_ktp')->store('/images-ktp');
        }

        Employee::where('id', $karyawan->id)
            ->update($validated);

        return redirect('dashboard/karyawan')->with('success', 'Data karyawan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $karyawan)
    {
        if ($karyawan->image_self) {
            Storage::delete($karyawan->image_self);
        }

        if ($karyawan->image_ktp) {
            Storage::delete($karyawan->image_ktp);
        }

        Employee::destroy($karyawan->id);
        return back()->with('success', 'Data karyawan berhasil dihapus.');
    }

    public function export(Employee $karyawan)
    {
        return view('dashboard.karyawan.print', [
            'title' => 'Detail_Karyawan_' . $karyawan->employee_id,
            'header' => 'Detail Karyawan',
            'employee' => $karyawan,
        ]);
    }
}
