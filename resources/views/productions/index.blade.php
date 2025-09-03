@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Produksi</h1>
        <a href="{{ route('productions.create') }}" class="btn btn-primary">+ Tambah Data Produksi</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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
                    </select>

                    <select name="employee_id" class="form-select">
                        <option value="">-- Semua Employee --</option>
                        @foreach($employees as $employee)
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
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Employee</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productions as $production)
                    <tr>
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
                            <a href="{{ route('productions.edit', $production->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('productions.destroy', $production->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-muted">Belum ada data produksi.</p>
            @endif
        </div>
    </div>
</div>
@endsection