<h1>Tambah Karyawan</h1>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama" required><br>
    <input type="text" name="department" placeholder="Departemen" required><br>
    <input type="text" name="position" placeholder="Posisi" required><br>
    <button type="submit">Simpan</button>
</form>

<a href="{{ route('employees.index') }}">Kembali</a>
