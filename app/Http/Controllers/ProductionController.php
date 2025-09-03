<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Employee;

class ProductionController extends Controller
{
    public function index()
    {
        $productions = Production::all();
        return view('productions.index', compact('productions'));
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
