<h1>Edit Karyawan</h1>

<form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $employee->name }}" required><br>
    <input type="text" name="department" value="{{ $employee->department }}" required><br>
    <input type="text" name="position" value="{{ $employee->position }}" required><br>
    <button type="submit">Update</button>
</form>

<a href="{{ route('employees.index') }}">Kembali</a>
