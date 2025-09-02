@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4">📊 Smart Factory Dashboard</h1>
    <p class="text-muted mb-4">Pantau kinerja pabrik dengan data real-time!</p>

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
    <div class="row mb-5">
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

    <!-- KPI Produksi -->
    <div class="row text-center mb-4">
        @foreach ([
        'Total' => ['value' => $totalProductions, 'color' => 'primary', 'icon' => '📦'],
        'Done' => ['value' => $doneCount, 'color' => 'success', 'icon' => '✅'],
        'In Progress' => ['value' => $progressCount, 'color' => 'warning', 'icon' => '⚙️'],
        'Todo' => ['value' => $todoCount, 'color' => 'danger', 'icon' => '🔜'],
        'Pending' => ['value' => $pendingCount, 'color' => 'secondary', 'icon' => '⏳']
        ] as $label => $info)
        <div class="col mb-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h6 class="fw-bold">{{ $info['icon'] }} {{ $label }}</h6>
                    <p class="fs-4 text-{{ $info['color'] }} mb-0">{{ $info['value'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Recent Activity -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <h5 class="mb-3">📝 Recent Activity</h5>
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
                        @forelse($recentProductions as $index => $production)
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
                                $color = $statusColors[$production->status] ?? 'dark';
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ ucfirst($production->status) }}</span>
                            </td>
                            <td>
                                {{ $production->created_at ? $production->created_at->format('d M Y H:i') : '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No recent production data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Charts Side by Side -->
    <div class="row mb-5">
        <!-- Bar Chart Produksi per Bulan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>📈 Produksi per Bulan</h6>
                    <canvas id="productionChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart Tren Produksi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>📊 Tren Produksi</h6>
                    <canvas id="trendChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart Status Produksi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6>🥧 Status Produksi</h6>
                    <div style="max-width: 300px; margin: 0 auto;">
                        <canvas id="statusChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donut Chart Distribusi Produk -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6>🍰 Distribusi Produksi per Produk</h6>
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
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endpush