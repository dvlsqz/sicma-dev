<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ings7Follow extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'ings7_follow';
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->hasOne(User::class,'id','iduser');
    }
}
