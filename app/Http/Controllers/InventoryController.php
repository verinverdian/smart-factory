<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::query();

        // Filter nama barang
        if ($request->filled('item_name')) {
            $query->where('item_name', 'like', '%' . $request->item_name . '%');
        }

        // Filter stok
        if ($request->filled('stock')) {
            $query->where('stock', $request->stock);
        }

        // Filter satuan
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        // Pagination 10 data per halaman
        $inventories = $query->paginate(10)->appends($request->all());

        // Ambil semua satuan unik untuk dropdown
        $units = Inventory::select('unit')->distinct()->pluck('unit');

        return view('inventories.index', compact('inventories', 'units'));
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

        Inventory::create($request->only(['item_name', 'stock', 'unit']));

        return redirect()
            ->route('inventories.index', $request->query())
            ->with('success', 'Data inventaris berhasil ditambahkan');;
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

        $inventory->update($request->except(['_token', '_method']));
        
        return redirect()
            ->route('inventories.index', $request->query())
            ->with('success', 'Data inventaris berhasil diperbarui');
    }

    public function destroy(Inventory $inventory, Request $request)
    {
        $inventory->delete();

        return redirect()
            ->route('inventories.index', $request->query())
            ->with('success', 'Data inventaris berhasil dihapus');
    }
}
