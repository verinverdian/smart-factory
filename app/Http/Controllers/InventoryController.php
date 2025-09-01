<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'stock' => 'required',
            'unit' => 'required'
        ]);
        
        Inventory::create($request->all());
        return redirect()->route('inventories.index')->with('success', 'Data inventaris berhasil ditambahkan');;
    }

    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'item_name' => 'required',
            'stock' => 'required',
            'unit' => 'required'
        ]);

        $inventory->update($request->all());
        return redirect()->route('inventories.index')->with('success', 'Data inventaris berhasil diperbarui');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Data inventaris berhasil dihapus');
    }
}
