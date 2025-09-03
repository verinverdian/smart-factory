<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department', 'position'];

    public function productions()
    {
        return $this->hasMany(Production::class, 'employee_id');
    }
}
