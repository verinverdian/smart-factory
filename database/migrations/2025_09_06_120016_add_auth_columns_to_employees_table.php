<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthColumnsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan kolom auth, nullable biar tidak error di SQLite
            if (!Schema::hasColumn('employees', 'email')) {
                $table->string('email')->unique()->nullable();
            }
            if (!Schema::hasColumn('employees', 'password')) {
                $table->string('password')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('employees', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
}
