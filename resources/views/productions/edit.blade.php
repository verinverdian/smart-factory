<h1>Edit Data Produksi</h1>

<form action="{{ route('productions.update', $production->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $production->product_name }}" required><br>
    <input type="text" name="department" value="{{ $production->quantity }}" required><br>
    <input type="text" name="position" value="{{ $production->status }}" required><br>
    <button type="submit">Update</button>
</form>

<a href="{{ route('productions.index') }}">Kembali</a>
