<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ings7FG extends Model
{
    use HasFactory;

    protected $table = 'ings7_files_gallery';
    protected $hidden = ['created_at', 'updated_at'];

    public function ing(){
        return $this->hasOne(Ings7::class,'id','iding7');
    }
}
