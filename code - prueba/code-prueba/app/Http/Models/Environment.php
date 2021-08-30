<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    use HasFactory;
    protected $table = 'environments';
    protected $hidden = ['created_at', 'updated_at'];

    
}
