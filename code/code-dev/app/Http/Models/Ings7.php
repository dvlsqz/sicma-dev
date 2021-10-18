<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ings7 extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ings7';
    protected $hidden = ['created_at', 'updated_at'];

    public function service(){
        return $this->hasOne(Environment::class,'id','idservice');
    }

    public function user(){
        return $this->hasOne(User::class,'id','idapplicant');
    }

    public function ings7f(){
        return $this->hasMany(Ings7Follow::class,'iding7','id');
    }

    public function ings7a(){
        return $this->hasMany(Ings7AssignmentArea::class,'iding7','id');
    }
}
