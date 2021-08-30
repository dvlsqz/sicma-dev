<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'departments';
    protected $hidden = ['created_at', 'updated_at'];
}
