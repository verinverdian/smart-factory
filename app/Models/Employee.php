<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'department', 'position', 'photo'];

    protected $hidden = ['password'];

    public function productions()
    {
        return $this->hasMany(Production::class, 'employee_id');
    }
}
