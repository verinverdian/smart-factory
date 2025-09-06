<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk isi tabel employees
     */
    public function run()
    {
        // Buat akun admin pabrik
        Employee::updateOrCreate(
            ['email' => 'admin@factory.com'],
            [
                'name' => 'Admin Pabrik',
                'department' => 'Produksi',
                'position' => 'Manager',
                'photo' => null,
                'password' => Hash::make('password123'), // password default
            ]
        );
    }
}
