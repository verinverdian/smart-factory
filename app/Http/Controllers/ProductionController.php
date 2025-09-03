<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Employee;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        $query = Production::query()->with('employee');

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

        $employees = Employee::all();

        return view('productions.index', compact('productions', 'employees'));
    }

    public function create()
    {
        $employees = Employee::all(); // ambil semua employee
        return view('productions.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'employee_id' => 'required'
        ]);

        Production::create($request->all());
        return redirect()->route('productions.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $production = Production::findOrFail($id);
        $employees = Employee::all(); // <- pastikan ini ada
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

        $production->update($request->all());
        return redirect()->route('productions.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Production $production)
    {
        $production->delete();
        return redirect()->route('productions.index')->with('success', 'Data berhasil dihapus');
    }
}
