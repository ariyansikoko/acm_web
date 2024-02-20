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
            'employee' => Employee::all(),
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
            'employee_id' => 'required|unique:employees|size:4',
            'name' => 'required|max:255',
            'birth_date' => 'nullable|required|date',
            'department' => 'required',
            'position_id' => 'required',
            'work_location' => 'required',
            'ptkp_status' => 'required',
            'image_self' => 'nullable|image|file|max:1024',
            'image_ktp' => 'nullable|image|file|max:1024',
            'start_date' => 'nullable|date',
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'salary' => 'nullable|numeric',
            'bank_name' => 'nullable',
            'account_number' => 'nullable|numeric',
            'ktp_number' => 'nullable|numeric',
            'bpjs' => 'nullable',
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $karyawan)
    {
        $rules = [
            'name' => 'required',
            'birth_date' => 'required|date',
            'department' => 'required',
            'position_id' => 'required',
            'work_location' => 'required',
            'ptkp_status' => 'required',
            'image_self' => 'nullable|image|file|max:1024',
            'image_ktp' => 'nullable|image|file|max:1024',
            'start_date' => 'nullable|date',
            'address' => 'nullable',
            'phone_number' => 'nullable|numeric',
            'salary' => 'nullable|numeric',
            'bank_name' => 'nullable',
            'account_number' => 'nullable|numeric',
            'ktp_number' => 'nullable|numeric',
            'bpjs' => 'nullable',
            'npwp' => 'nullable',
            'blood_type' => 'required',
            'emergency_contact' => 'nullable',
            'emergency_number' => 'nullable|numeric',
        ];

        if ($request->employee_id != $karyawan->employee_id) {
            $rules['employee_id'] = 'required|unique:employees|digits:4';
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
        return redirect('dashboard/karyawan')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
