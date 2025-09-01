<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;

class ProductionController extends Controller
{
    public function index()
    {
        $productions = Production::all();
        return view('productions.index', compact('productions'));
    }

    public function create()
    {
        return view('productions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'status' => 'required'
        ]);

        Production::create($request->all());
        return redirect()->route('productions.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Production $production)
    {
        return view('productions.edit', compact('production'));
    }

    public function update(Request $request, Production $production)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'status' => 'required'
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
