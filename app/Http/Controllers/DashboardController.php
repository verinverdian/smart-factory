<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Production;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        // Recent activity
        $recentProductions = Production::with('employee')
            ->latest()
            ->take(5)
            ->get();

        // ===== Distribusi produksi per produk =====
        $productCountsByLabel = Production::select('product_name', DB::raw('COUNT(*) as total'))
            ->groupBy('product_name')
            ->pluck('total', 'product_name');

        $productLabels = $productCountsByLabel->keys()->values();
        $productCounts = $productCountsByLabel->values();

        $prodEmployeeRows = Production::with('employee')
            ->select('product_name', 'employee_id')
            ->groupBy('product_name', 'employee_id')
            ->get();

        $employeesPerProduct = $prodEmployeeRows
            ->groupBy('product_name')
            ->map(function ($group) {
                return $group->pluck('employee.name')->filter()->unique()->values();
            });

        $productEmployees = $productLabels->map(function ($label) use ($employeesPerProduct) {
            return isset($employeesPerProduct[$label]) ? $employeesPerProduct[$label] : collect();
        })->values();

        // 🎯 Target produksi bulan ini (contoh: 50 produk)
        $targetProductions = 50;

        // 🏆 Top Employees (pakai join biar tidak duplikat/empty)
        $topEmployees = Production::join('employees', 'productions.employee_id', '=', 'employees.id')
            ->select('employees.name', DB::raw('COUNT(productions.id) as total'))
            ->groupBy('employees.id', 'employees.name')
            ->orderByDesc('total')
            ->take(3)
            ->get();

        $topProducts = Production::select('product_name', DB::raw('COUNT(*) as total'))
            ->groupBy('product_name')
            ->orderByDesc('total')
            ->take(5)
            ->get();


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
            'recentProductions',
            'productLabels',
            'productCounts',
            'productEmployees',
            'targetProductions', // 🎯 progress bar
            'topEmployees',       // 🏆 leaderboard
            'topProducts'
        ));
    }
}
