<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ tambahkan baris ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            ['name' => 'Budi Santoso', 'department' => 'Produksi', 'position' => 'Operator', 'photo' => null],
            ['name' => 'Siti Aminah', 'department' => 'Gudang', 'position' => 'Staff', 'photo' => null],
            ['name' => 'Andi Santoso', 'department' => 'Produksi', 'position' => 'Operator', 'photo' => null],
            ['name' => 'Budi Raharjo', 'department' => 'Produksi', 'position' => 'Supervisor', 'photo' => null],
            ['name' => 'Citra Lestari', 'department' => 'Gudang', 'position' => 'Staff', 'photo' => null],
            ['name' => 'Dedi Kurniawan', 'department' => 'QC', 'position' => 'Inspector', 'photo' => null],
            ['name' => 'Eka Putra', 'department' => 'Produksi', 'position' => 'Operator', 'photo' => null],
            ['name' => 'Fajar Pratama', 'department' => 'IT', 'position' => 'Developer', 'photo' => null],
            ['name' => 'Gita Ramadhani', 'department' => 'HR', 'position' => 'HRD', 'photo' => null],
            ['name' => 'Hadi Wijaya', 'department' => 'QC', 'position' => 'Inspector', 'photo' => null],
            ['name' => 'Indra Maulana', 'department' => 'Gudang', 'position' => 'Staff', 'photo' => null],
            ['name' => 'Joko Santoso', 'department' => 'Produksi', 'position' => 'Operator', 'photo' => null],
            ['name' => 'Kiki Amalia', 'department' => 'IT', 'position' => 'Developer', 'photo' => null],
            ['name' => 'Lina Susanti', 'department' => 'HR', 'position' => 'HRD', 'photo' => null],
            ['name' => 'Maman Hidayat', 'department' => 'Produksi', 'position' => 'Supervisor', 'photo' => null],
            ['name' => 'Nina Oktaviani', 'department' => 'QC', 'position' => 'Inspector', 'photo' => null],
            ['name' => 'Oki Prasetyo', 'department' => 'Gudang', 'position' => 'Staff', 'photo' => null],
        ]);

        DB::table('inventories')->insert([
            ['item_name' => 'Kayu Jati', 'stock' => 120, 'unit' => 'm3'],
            ['item_name' => 'Cat Finishing', 'stock' => 50, 'unit' => 'liter'],
            ['item_name' => 'Baut M6', 'stock' => 100, 'unit' => 'pcs'],
            ['item_name' => 'Mur M6', 'stock' => 200, 'unit' => 'pcs'],
            ['item_name' => 'Paku 5cm', 'stock' => 500, 'unit' => 'pcs'],
            ['item_name' => 'Cat Putih', 'stock' => 50, 'unit' => 'liter'],
            ['item_name' => 'Cat Hitam', 'stock' => 60, 'unit' => 'liter'],
            ['item_name' => 'Sekrup 3cm', 'stock' => 300, 'unit' => 'pcs'],
            ['item_name' => 'Kabel Listrik 2m', 'stock' => 150, 'unit' => 'roll'],
            ['item_name' => 'Kabel Listrik 5m', 'stock' => 100, 'unit' => 'roll'],
            ['item_name' => 'Tang', 'stock' => 30, 'unit' => 'pcs'],
            ['item_name' => 'Obeng', 'stock' => 40, 'unit' => 'pcs'],
            ['item_name' => 'Palet Kayu', 'stock' => 20, 'unit' => 'pcs'],
            ['item_name' => 'Pipa PVC 1inch', 'stock' => 80, 'unit' => 'pcs'],
            ['item_name' => 'Pipa PVC 2inch', 'stock' => 50, 'unit' => 'pcs'],
            ['item_name' => 'Lem Kayu', 'stock' => 25, 'unit' => 'liter'],
            ['item_name' => 'Selotip', 'stock' => 70, 'unit' => 'roll'],
        ]);

        DB::table('productions')->insert([
            ['product_name' => 'Meja Makan', 'quantity' => 10, 'status' => 'progress', 'employee_id' => null, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Kursi Tamu', 'quantity' => 25, 'status' => 'done', 'employee_id' => null, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Meja Kayu', 'quantity' => 10, 'status' => 'todo', 'employee_id' => 1, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Kursi Kayu', 'quantity' => 15, 'status' => 'progress', 'employee_id' => 2, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Rak Buku', 'quantity' => 5, 'status' => 'done', 'employee_id' => 3, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Lemari', 'quantity' => 7, 'status' => 'todo', 'employee_id' => 4, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Meja Kantor', 'quantity' => 12, 'status' => 'progress', 'employee_id' => 5, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Kursi Kantor', 'quantity' => 20, 'status' => 'done', 'employee_id' => 6, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Rak Dapur', 'quantity' => 8, 'status' => 'todo', 'employee_id' => 7, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Lemari Pakaian', 'quantity' => 6, 'status' => 'progress', 'employee_id' => 8, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Meja Belajar', 'quantity' => 10, 'status' => 'done', 'employee_id' => 9, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Kursi Belajar', 'quantity' => 14, 'status' => 'todo', 'employee_id' => 10, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Rak Sepatu', 'quantity' => 9, 'status' => 'progress', 'employee_id' => 11, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Meja Tamu', 'quantity' => 4, 'status' => 'done', 'employee_id' => 12, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Kursi Tamu', 'quantity' => 7, 'status' => 'todo', 'employee_id' => 13, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Rak Mainan', 'quantity' => 15, 'status' => 'progress', 'employee_id' => 14, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
            ['product_name' => 'Lemari Arsip', 'quantity' => 5, 'status' => 'done', 'employee_id' => 15, 'created_at' => now()->subMonths(rand(0, 8)), 'updated_at' => now()],
        ]);
    }
}
