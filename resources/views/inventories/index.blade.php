<h1>Daftar Inventaris</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<a href="{{ route('inventories.create') }}">Tambah Karyawan</a>

<ul>
    @foreach($inventories as $inventory)
        <li>
            {{ $inventory->item_name }} - {{ $inventory->stock }} ({{ $inventory->unit }})
            <a href="{{ route('inventories.edit', $inventory->id) }}">Edit</a>
            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>
