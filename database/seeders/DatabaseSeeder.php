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
        ]);
    
        DB::table('inventories')->insert([
            ['item_name' => 'Kayu Jati', 'stock' => 120, 'unit' => 'm3'],
            ['item_name' => 'Cat Finishing', 'stock' => 50, 'unit' => 'liter'],
        ]);
    
        DB::table('productions')->insert([
            ['product_name' => 'Meja Makan', 'quantity' => 10, 'status' => 'progress'],
            ['product_name' => 'Kursi Tamu', 'quantity' => 25, 'status' => 'done'],
        ]);
    }    
}
