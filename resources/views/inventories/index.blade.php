@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Inventaris</h1>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">+ Tambah Inventaris</a>
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
                <form action="{{ route('inventories.index') }}" method="GET" class="mb-3 d-flex gap-2">
                    <input type="text" name="item_name" class="form-control" placeholder="Cari nama barang..." value="{{ request('item_name') }}">

                    <input type="number" name="stock" class="form-control" placeholder="Stok" value="{{ request('stock') }}">

                    <select name="unit" class="form-select">
                        <option value="">-- Semua Satuan --</option>
                        @foreach($units as $unit)
                        <option value="{{ $unit }}" {{ request('unit') == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Reset</a>
                </form>
                <script>
                    function submitFilter() {
                        document.getElementById('filterForm').submit();
                    }

                    // Debounce untuk input teks agar tidak submit tiap huruf
                    let debounceTimer;

                    function debounceSubmit() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            submitFilter();
                        }, 500); // 500ms delay
                    }
                </script>

            </div>
            @if($inventories->count() > 0)
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->item_name }}</td>
                        <td>{{ $inventory->stock }}</td>
                        <td>{{ $inventory->unit }}</td>
                        <td class="text-center">
                            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" class="d-inline">
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
            <p class="text-muted">Belum ada data inventaris.</p>
            @endif
        </div>
    </div>
</div>
@endsection