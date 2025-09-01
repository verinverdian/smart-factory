<h1>Tambah Inventaris</h1>

<form method="POST" action="{{ route('inventories.store') }}">
    @csrf
    Nama Barang: <input type="text" name="item_name" required><br>
    Jumlah: <input type="number" name="stock" required><br>
    Lokasi: <input type="text" name="unit" required><br>
    <button type="submit">Simpan</button>
</form>

<a href="{{ route('inventories.index') }}">Kembali</a>
