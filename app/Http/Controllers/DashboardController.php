<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Production;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str; // jika ingin pakai helper string

class DashboardController extends Controller
{
    public function index()
    {
        $employeesCount   = Employee::count();
        $inventoriesCount = Inventory::count();
        $productionsCount = Production::count();

        // KPI ringkas
        $totalProductions = $productionsCount;
        $doneCount        = Production::where('status', 'done')->count();
        $progressCount    = Production::where('status', 'progress')->count();
        $todoCount        = Production::where('status', 'todo')->count();
        $pendingCount     = Production::where('status', 'pending')->count();

        // Produksi per bulan (bar chart)
        $productionsPerMonth = Production::selectRaw('strftime("%m", created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $allMonths = collect(range(1, 12))->mapWithKeys(function ($m) {
            $key = str_pad($m, 2, '0', STR_PAD_LEFT);
            return [$key => 0];
        });

        $finalData = $allMonths->merge($productionsPerMonth);

        $chartLabels = $finalData->keys()->map(function ($m) {
            return Carbon::create()->month((int)$m)->format('F');
        });

        $chartData = $finalData->values();

        // Produksi per status (pie chart)
        $statusData = Production::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusLabels = $statusData->keys();
        $statusCounts = $statusData->values();

        // Recent activity: ambil 5 data terakhir dengan relasi employee
        $recentProductions = Production::with('employee')
            ->latest()
            ->take(5)
            ->get();

        // Distribusi produksi per product_name
        $productData = Production::selectRaw('product_name, COUNT(*) as total')
            ->groupBy('product_name')
            ->pluck('total', 'product_name');

        $productLabels = $productData->keys();
        $productCounts = $productData->values();

        return view('dashboard', compact(
            'employeesCount',
            'inventoriesCount',
            'productionsCount',
            'chartLabels',
            'chartData',
            'statusLabels',
            'statusCounts',
            'totalProductions',
            'doneCount',
            'progressCount',
            'pendingCount',
            'todoCount',
            'recentProductions', // sudah include relasi employee
            'productLabels',
            'productCounts'
        ));
    }
}