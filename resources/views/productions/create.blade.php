@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Tambah Produksi</h1>

    <form action="{{ route('productions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produksi</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Masukkan nama produksi" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan jumlah" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="todo">Todo</option>
                <option value="progress">In Progress</option>
                <option value="done">Done</option>
                <option value="pending">Pending</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('productions.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection