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

        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // paginate 10 dan menambahkan query string filter agar tetap aktif
        $productions = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());

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

    public function exportCsvManual(Request $request)
    {
        $filters = $request->only(['product_name', 'status', 'employee_id']);

        // Ambil data dengan filter
        $query = \App\Models\Production::with('employee');

        if (!empty($filters['product_name'])) {
            $query->where('product_name', 'like', '%' . $filters['product_name'] . '%');
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['employee_id'])) {
            $query->where('employee_id', $filters['employee_id']);
        }

        $productions = $query->get();

        // Nama file
        $fileName = "productions.csv";

        // Header HTTP supaya browser download
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Callback untuk output CSV
        $callback = function () use ($productions) {
            $file = fopen('php://output', 'w');

            // Header kolom
            fputcsv($file, ['Nama Produk', 'Jumlah', 'Status', 'Nama Employee']);

            // Isi data
            foreach ($productions as $p) {
                // Mapping status dengan switch agar compatible PHP 7.x
                switch ($p->status) {
                    case 'done':
                        $statusLabel = 'Done';
                        break;
                    case 'progress':
                        $statusLabel = 'In Progress';
                        break;
                    case 'todo':
                        $statusLabel = 'To Do';
                        break;
                    case 'pending':
                        $statusLabel = 'Pending';
                        break;
                    default:
                        $statusLabel = $p->status;
                }

                fputcsv($file, [
                    $p->product_name,
                    $p->quantity,
                    $statusLabel,
                    $p->employee->name ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
