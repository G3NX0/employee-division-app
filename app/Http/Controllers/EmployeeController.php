<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan semua data employee
     */
    public function index()
    {
        $employees = Employees::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form tambah karyawan
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'required|integer|min:0|max:150',
            'nis' => 'required|string|max:50|unique:employees,nis',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employees', 'public');
            $validated['photo'] = $path;
            $validated['photo_uploaded_at'] = now();
        }

        Employees::create($validated);

        return redirect('employees')->with('success', 'Employee added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit data berdasarkan ID
     */
    public function edit($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate data employee
     */
    public function update(Request $request, $id)
    {
        $employee = Employees::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'required|integer|min:0|max:150',
            'nis' => 'required|string|max:50|unique:employees,nis,' . $employee->id,
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $path = $request->file('photo')->store('employees', 'public');
            $validated['photo'] = $path;
            $validated['photo_uploaded_at'] = now();
        }

        $employee->update($validated);

        return redirect('employees')->with('success', 'Employee updated successfully!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail employee
     */
    public function show($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus data employee
     */
    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();

        return redirect('employees')->with('success', 'Employee deleted successfully!');
    }
}
