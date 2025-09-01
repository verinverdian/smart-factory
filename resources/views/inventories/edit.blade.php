<h1>Edit Data Inventaris</h1>

<form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="item_name" value="{{ $inventory->item_name }}" required><br>
    <input type="text" name="stock" value="{{ $inventory->stock }}" required><br>
    <input type="text" name="unit" value="{{ $inventory->unit }}" required><br>
    <button type="submit">Update</button>
</form>

<a href="{{ route('inventories.index') }}">Kembali</a>
