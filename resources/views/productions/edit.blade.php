@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Data Produksi</h1>

    <form action="{{ route('productions.update', $production->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Produksi -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produksi</label>
            <input type="text" class="form-control" id="product_name" name="product_name" 
                   value="{{ old('product_name', $production->product_name) }}" required>
        </div>

        <!-- Jumlah -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" 
                   value="{{ old('quantity', $production->quantity) }}" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="todo" {{ old('status', $production->status) == 'todo' ? 'selected' : '' }}>Todo</option>
                <option value="progress" {{ old('status', $production->status) == 'progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ old('status', $production->status) == 'done' ? 'selected' : '' }}>Done</option>
                <option value="pending" {{ old('status', $production->status) == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <!-- Karyawan -->
        <div class="mb-3">
            <label for="employee_id" class="form-label">Karyawan</label>
            <select class="form-select" id="employee_id" name="employee_id" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" 
                        {{ old('employee_id', $production->employee_id) == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('productions.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection
