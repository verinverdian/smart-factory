<h1>Tambah Produksi</h1>

<form action="{{ route('productions.store') }}" method="POST">
    @csrf
    <input type="text" name="product_name" placeholder="Nama Produksi" required><br>
    <input type="text" name="quantity" placeholder="Jumlah" required><br>
    <input type="text" name="status" placeholder="Status" required><br>
    <button type="submit">Simpan</button>
</form>

<a href="{{ route('productions.index') }}">Kembali</a>
