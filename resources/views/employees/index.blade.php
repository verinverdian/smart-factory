<h1>Daftar Karyawan</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<a href="{{ route('employees.create') }}">Tambah Karyawan</a>

<ul>
    @foreach($employees as $employee)
        <li>
            {{ $employee->name }} - {{ $employee->department }} ({{ $employee->position }})
            <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>
