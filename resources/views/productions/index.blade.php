<h1>Daftar Produksi</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<a href="{{ route('productions.create') }}">Tambah Data Produksi</a>

<ul>
    @foreach($productions as $production)
        <li>
            {{ $production->product_name }} - {{ $production->quantity }} ({{ $production->status }})
            <a href="{{ route('productions.edit', $production->id) }}">Edit</a>
            <form action="{{ route('productions.destroy', $production->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>
