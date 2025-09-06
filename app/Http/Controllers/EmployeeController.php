<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Filter nama
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter departemen
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Filter posisi
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        // Pagination 10 data per halaman
        $employees = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());

        // Ambil semua departemen dan posisi unik untuk dropdown
        $departments = Employee::select('department')->distinct()->pluck('department');
        $positions = Employee::select('position')->distinct()->pluck('position');

        return view('employees.index', compact('employees', 'departments', 'positions'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
            'position' => 'required'
        ]);

        // hanya ambil data untuk karyawan
        Employee::create($request->only(['name', 'department', 'position']));

        // balikin ke halaman dengan filter terakhir
        return redirect()
            ->route('employees.index', $request->query())
            ->with('success', 'Karyawan berhasil ditambahkan');
    }


    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
            'position' => 'required'
        ]);

        $employee->update($request->except(['_token', '_method']));

        return redirect()
            ->route('employees.index', $request->query())
            ->with('success', 'Karyawan berhasil diperbarui');
    }

    public function destroy(Employee $employee, Request $request)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index', $request->query())
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
