<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'quantity', 'status', 'employee_id'];

    /**
     * Relasi ke Employee
     * Satu produksi dimiliki oleh satu karyawan
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
