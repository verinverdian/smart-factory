@extends('layouts.app')

@section('title', '📦 Inventories | Smart Factory')

@section('content')
<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Inventaris</h1>
        <a href="{{ route('inventories.create', request()->query()) }}" class="btn btn-primary">+ Tambah Inventaris</a>
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
                <form action="{{ route('inventories.index') }}" method="GET" class="mb-3 d-flex gap-2">
                    <input type="text" name="item_name" class="form-control form-control-sm" placeholder="Cari nama barang..." value="{{ request('item_name') }}">

                    <input type="number" name="stock" class="form-control form-control-sm" placeholder="Stok" value="{{ request('stock') }}">

                    <select name="unit" class="form-select form-select-sm">
                        <option value="">-- Semua Satuan --</option>
                        @foreach($units as $unit)
                        <option value="{{ $unit }}" {{ request('unit') == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('inventories.index') }}" class="btn btn-sm btn-secondary">Reset</a>
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
                            <a href="{{ route('inventories.edit', [$inventory->id] + request()->query()) }}" class="btn btn-sm btn-warning">Edit</a>
                            <!-- Tombol Trigger Modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteInventoryModal{{ $inventory->id }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteInventoryModal{{ $inventory->id }}" tabindex="-1" aria-labelledby="deleteInventoryModalLabel{{ $inventory->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteInventoryModalLabel{{ $inventory->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Apakah kamu yakin ingin menghapus <b>{{ $inventory->item_name }}</b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('inventories.destroy', [$inventory->id] + request()->query()) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $inventories->links('pagination::bootstrap-4') }}
            </div>
            @else
            <p class="text-muted">Belum ada data inventaris.</p>
            @endif
        </div>
    </div>
</div>
@endsection