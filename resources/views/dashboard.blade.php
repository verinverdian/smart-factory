@extends('layouts.app')

@section('title', '📊 Dashboard | Smart Factory')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mt-5 mb-4 pt-4">📊 Smart Factory Dashboard</h1>
    <p class="text-muted mb-4">Pantau kinerja pabrik dengan data real-time!</p>

    <!-- Alert Sapaan -->
    @if(Auth::check())
    <div class="alert alert-light border shadow-sm alert-dismissible fade show mt-4 rounded-3 mb-5" role="alert">
        👋 Hai <strong>{{ Auth::user()->name }}</strong>, selamat datang kembali di <b>Smart Factory Dashboard</b>!
        Semoga harimu produktif 🚀
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistik Ringkas -->
    <div class="row text-center mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold">👨‍💼 Employees</h5>
                    <p class="fs-4 text-primary">{{ $employeesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold">📦 Inventories</h5>
                    <p class="fs-4 text-success">{{ $inventoriesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold">⚙️ Productions</h5>
                    <p class="fs-4 text-warning">{{ $productionsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi Cepat -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <a href="{{ route('employees.index') }}" class="btn btn-outline-primary w-100 shadow-sm">
                👨‍💼 Kelola Employees
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('inventories.index') }}" class="btn btn-outline-success w-100 shadow-sm">
                📦 Kelola Inventories
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('productions.index') }}" class="btn btn-outline-warning w-100 shadow-sm">
                ⚙️ Kelola Productions
            </a>
        </div>
    </div>

    <!-- Target vs Realisasi & Top Employee-->
    <div class="row align-items-stretch mb-4">
        <!-- Target vs Realisasi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 p-4 rounded-3 h-100">
                <h5 class="fw-bold mb-4">🎯 Target vs Realisasi</h5>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-center flex-fill border-end">
                        <p class="text-muted mb-1">Target</p>
                        <h3 class="fw-bold text-secondary">{{ $targetProductions }}</h3>
                        <small class="text-muted">produk</small>
                    </div>
                    <div class="text-center flex-fill">
                        <p class="text-muted mb-1">Realisasi</p>
                        <h3 class="fw-bold text-primary">{{ $productionsCount }}</h3>
                        <small class="text-muted">produk</small>
                    </div>
                </div>

                <!-- Progress Bar -->
                @php
                $progress = min(($productionsCount / $targetProductions) * 100, 100);
                if ($progress >= 100) {
                $progressClass = 'bg-success';
                } elseif ($progress >= 70) {
                $progressClass = 'bg-warning text-dark';
                } else {
                $progressClass = 'bg-danger';
                }
                @endphp

                <div class="progress mb-2" style="height: 25px;">
                    <div class="progress-bar {{ $progressClass }} fw-semibold" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        {{ round($progress, 1) }}%
                    </div>
                </div>

                <p class="text-muted mt-2 mb-0">
                    Capaian bulan ini: <strong>{{ round($progress, 1) }}%</strong>
                </p>
            </div>
        </div>

        <!-- Top Employee -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 p-4 rounded-3 h-100">
                <h5 class="fw-bold mb-3">🏆 Top Employee</h5>

                @if ($topEmployees->isNotEmpty())
                <div class="alert alert-warning rounded-3 fw-bold d-flex align-items-center">
                    🏅 Top Performer (Bulan Ini):
                    {{ $topEmployees[0]->name }} ({{ $topEmployees[0]->total }} produk)
                    @if ($topEmployees[0]->photo)
                    <img src="{{ asset('storage/'.$topEmployees[0]->photo) }}" alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                    @else
                    <div class="border-1 text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width:30px; height:30px; font-size:12px; margin-left:8px; background-color:rgb(102 77 3);">
                        {{ strtoupper(substr($topEmployees[0]->name,0,2)) }}
                    </div>
                    @endif
                </div>
                @endif

                <ol class="list-group list-group-numbered">
                    @foreach ($topEmployees as $employee)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="text-start">{{ $employee->name }}</span>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $employee->total }} produk</span>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <!-- Top Produk -->
    <div class="card shadow-sm border-0 p-4 rounded-3 h-100 mb-5">
        <h5 class="fw-bold mb-3">🔥 Top Produk</h5>

        @if ($topProducts->isNotEmpty())
        <div class="alert alert-info rounded-3 fw-bold">
            🥇 Produk Terlaris:
            {{ $topProducts[0]->product_name }} ({{ $topProducts[0]->total }} produksi)
        </div>
        @endif

        <ol class="list-group list-group-numbered">
            @foreach ($topProducts as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-start">{{ $product->product_name }}</span>
                <span class="badge bg-primary rounded-pill">{{ $product->total }} produk</span>
            </li>
            @endforeach
        </ol>
    </div>

    <!-- KPI Produksi -->
    <div class="mt-4 mb-2">
        <h5 class="fw-bold mb-4">📌 Key Performance Indicator Produksi</h5>
    </div>
    <div class="row text-center mb-4">
        @foreach ([
        'Total' => ['value' => $totalProductions, 'color' => 'primary', 'icon' => '📦', 'link' => '/productions'],
        'Done' => ['value' => $doneCount, 'color' => 'success', 'icon' => '✅', 'link' => '/productions?product_name=&status=done'],
        'In Progress' => ['value' => $progressCount, 'color' => 'warning', 'icon' => '⚙️', 'link' => '/productions?product_name=&status=progress'],
        'Todo' => ['value' => $todoCount, 'color' => 'danger', 'icon' => '🔜', 'link' => '/productions?product_name=&status=todo'],
        'Pending' => ['value' => $pendingCount, 'color' => 'secondary', 'icon' => '⏳', 'link' => '/productions?product_name=&status=pending']
        ] as $label => $info)
        <div class="col mb-3">
            <div class="card border-0 shadow-sm rounded-3">
                <a href="{{ $info['link'] }}" class="text-decoration-none">
                    <div class="card-body">
                        <h6 class="fw-bold text-black">{{ $info['icon'] }} {{ $label }}</h6>
                        <p class="fs-4 text-{{ $info['color'] }} mb-0">{{ $info['value'] ?? 0 }}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    @php
    // Accept either $productions (controller newer) or $recentProductions (older)
    $recentList = $productions ?? $recentProductions ?? collect();
    @endphp

    <!-- Recent Activity -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">📝 Recent Activity</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Production Name</th>
                            <th>Employee</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentList as $index => $production)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $production->product_name }}</td>
                            <td>{{ optional($production->employee)->name ?? '-' }}</td>
                            <td>
                                @php
                                $statusColors = [
                                'todo' => 'danger',
                                'progress' => 'warning',
                                'done' => 'success',
                                'pending' => 'secondary'
                                ];
                                $color = $statusColors[strtolower($production->status ?? '')] ?? 'dark';
                                @endphp
                                <span class="badge bg-{{ $color }}">
                                    {{ ucfirst($production->status ?? '-') }}
                                </span>
                            </td>
                            <td>
                                {{ optional($production->created_at)->format('d M Y H:i') ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No recent production data.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="text-end mt-1">
                    <a href="/productions" class="small fst-italic text-decoration-none">
                        Lihat semua data produksi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Side by Side -->
    <div class="row mb-4">
    <h5 class="fw-bold mb-4">📊 Total Produksi Tahun Ini</h5>
        <!-- Bar Chart Produksi per Bulan -->
        <div class="col-md-6 mb-5">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>📈 Produksi per Bulan</h6>
                    <canvas id="productionChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart Tren Produksi -->
        <div class="col-md-6 mb-5">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>📊 Tren Produksi</h6>
                    <canvas id="trendChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart Status Produksi -->
        <div class="col-md-6 mb-5">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6>⏳ Status Produksi</h6>
                    <div style="max-width: 300px; margin: 0 auto;">
                        <canvas id="statusChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donut Chart Distribusi Produk -->
        <div class="col-md-6 mb-5">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6>📦 Distribusi Produksi per Produk</h6>
                    <div style="max-width: 300px; margin: 0 auto;">
                        <canvas id="productChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quotes Motivasi -->
    <div class="text-center mt-4">
        <blockquote class="blockquote">
            <p class="mb-0 fst-italic">“Great factories are built with small steps – and good management 😉”</p>
            <footer class="blockquote-footer mt-2">Smart Factory Team</footer>
        </blockquote>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart Produksi per Bulan
        const ctxBar = document.getElementById('productionChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Jumlah Produksi',
                    data: @json($chartData ?? []),
                    borderWidth: 1,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Line Chart Tren Produksi
        const ctxLine = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Produksi',
                    data: @json($chartData),
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Pie Chart Status Produksi
        const ctxPie = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: @json($statusLabels),
                datasets: [{
                    label: 'Productions by Status',
                    data: @json($statusCounts),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(108, 117, 125, 0.6)' // pending/other
                    ]
                }]
            }
        });

        // Donut Chart Distribusi Produk
        const ctxDonut = document.getElementById('productChart').getContext('2d');

        // data employee per produk dari backend
        const employees = @json($productEmployees);

        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: @json($productLabels),
                datasets: [{
                    label: 'Produksi per Produk',
                    data: @json($productCounts),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 50,
                            padding: 10
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const productIndex = context.dataIndex;

                                // ambil list karyawan dari data backend
                                const employeeList = employees[productIndex] || [];

                                return `${label}: ${value} (By: ${employeeList.join(', ')})`;
                            }
                        }
                    }
                }
            }
        });

    });
</script>
@endpush