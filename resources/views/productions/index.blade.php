@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Produksi</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('productions.create', request()->query()) }}" class="btn btn-primary">+ Tambah Data Produksi</a>
            <a href="{{ route('productions.exportManual', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export CSV
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Filter -->
            <div class="mt-2 mb-2">
                <form action="{{ route('productions.index') }}" method="GET" class="mb-3 d-flex gap-2">
                    <input type="text" name="product_name" class="form-control" placeholder="Cari nama produk..." value="{{ request('product_name') }}">

                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>

                    <select name="employee_id" class="form-select">
                        <option value="">-- Semua Employee (Dept. Produksi) --</option>
                        @foreach($employees->where('department', 'Produksi') as $employee)
                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('productions.index') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>

            @if($productions->count() > 0)
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Employee</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productions as $index => $production)
                    <tr>
                        <!-- Nomor urut per halaman -->
                        <td>{{ ($productions->currentPage() - 1) * $productions->perPage() + $index + 1 }}</td>
                        <td>{{ $production->product_name }}</td>
                        <td>{{ $production->quantity }}</td>
                        <td>
                            @if($production->status == 'done')
                            <span class="badge bg-success">Done</span>
                            @elseif($production->status == 'progress')
                            <span class="badge bg-warning text-dark">In Progress</span>
                            @elseif($production->status == 'todo')
                            <span class="badge bg-danger text-dark">To Do</span>
                            @else
                            <span class="badge bg-secondary">{{ $production->status }}</span>
                            @endif
                        </td>
                        <td>{{ optional($production->employee)->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('productions.edit', [$production->id] + request()->query()) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('productions.destroy', [$production->id] + request()->query()) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $productions->links('pagination::bootstrap-4') }}
            </div>

            @else
            <p class="text-muted">Belum ada data produksi.</p>
            @endif
        </div>
    </div>
</div>
@endsection