<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Employee;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        $query = Production::query();

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // paginate 10 dan menambahkan query string filter agar tetap aktif
        $productions = $query->paginate(10)->appends($request->all());

        // Ambil karyawan Departemen Produksi untuk dropdown filter
        $employees = Employee::where('department', 'Produksi')
            ->orderBy('name')
            ->get();

        return view('productions.index', compact('productions', 'employees'));
    }

    public function create(Request $request)
    {
        // Hanya karyawan Produksi
        $employees = Employee::where('department', 'Produksi')
            ->orderBy('name')
            ->get();

        // Kirim filter index sebagai old value supaya tetap aktif
        $filters = $request->only(['product_name', 'status', 'employee_id']);

        return view('productions.create', compact('employees', 'filters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'employee_id' => 'required'
        ]);

        Production::create($request->only(['product_name', 'quantity', 'status', 'employee_id']));

        return redirect()
            ->route('productions.index', $request->query())
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        // Ambil data production
        $production = Production::findOrFail($id);

        // Ambil karyawan Produksi untuk dropdown
        $employees = Employee::where('department', 'Produksi')
            ->orderBy('name')
            ->get();

        return view('productions.edit', compact('production', 'employees'));
    }

    public function update(Request $request, Production $production)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'employee_id' => 'required'
        ]);

        $production->update($request->except(['_token', '_method']));

        return redirect()
            ->route('productions.index', $request->query())
            ->with('success', 'Data berhasil diperbarui');
    }


    public function destroy(Production $production, Request $request)
    {
        $production->delete();

        return redirect()
            ->route('productions.index', $request->query())
            ->with('success', 'Data berhasil dihapus');
    }
}
