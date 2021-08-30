<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'municipalities';
    protected $hidden = ['created_at', 'updated_at'];

    public function dep(){
        return $this->hasOne(Departments::class,'id','department_id');
    }
}
