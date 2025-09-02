@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Data Produksi</h1>

    <form action="{{ route('productions.update', $production->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produksi</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $production->product_name }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $production->quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="todo" {{ $production->status == 'todo' ? 'selected' : '' }}>Todo</option>
                <option value="progress" {{ $production->status == 'progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ $production->status == 'done' ? 'selected' : '' }}>Done</option>
                <option value="pending" {{ $production->status == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('productions.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection