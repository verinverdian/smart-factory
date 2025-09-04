@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4">
    <h1 class="mb-4">Tambah Karyawan</h1>

    <form action="{{ route('employees.store', request()->query()) }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Departemen</label>
            <input type="text" class="form-control" id="department" name="department" placeholder="Masukkan departemen" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Posisi</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="Masukkan posisi" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection