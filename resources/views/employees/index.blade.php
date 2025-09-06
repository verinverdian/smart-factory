@extends('layouts.app')

@section('title', '👨‍💼 Employees | Smart Factory')

@section('content')
<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Karyawan</h1>
        <a href="{{ route('employees.create', request()->query()) }}" class="btn btn-primary">+ Tambah Karyawan</a>
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
                <form action="{{ route('employees.index') }}" method="GET" class="mb-3 d-flex gap-2">
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Cari nama..." value="{{ request('name') }}">

                    <select name="department" class="form-select form-select-sm">
                        <option value="">-- Semua Departemen --</option>
                        @foreach($departments as $department)
                        <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                        @endforeach
                    </select>

                    <select name="position" class="form-select form-select-sm">
                        <option value="">-- Semua Posisi --</option>
                        @foreach($positions as $position)
                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                            {{ $position }}
                        </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-sm btn-secondary">Reset</a>
                </form>
            </div>
            @if($employees->count() > 0)
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Posisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->position }}</td>
                        <td class="text-center">
                            <a href="{{ route('employees.edit', [$employee->id] + request()->query()) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('employees.destroy', [$employee->id] + request()->query()) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                @foreach(request()->query() as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $employees->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
            @else
            <p class="text-muted">Belum ada data karyawan.</p>
            @endif
        </div>
    </div>
</div>
@endsection