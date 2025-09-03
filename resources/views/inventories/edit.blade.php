@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-4">
    <h1 class="mb-4">Edit Data Inventaris</h1>

    <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="item_name" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $inventory->item_name }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $inventory->stock }}" required>
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Satuan / Lokasi</label>
            <input type="text" class="form-control" id="unit" name="unit" value="{{ $inventory->unit }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('inventories.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection