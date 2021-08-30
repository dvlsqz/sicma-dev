<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_equip_environment extends Model
{
    use HasFactory;
    protected $table = 'images_equip_environments';
    protected $hidden = ['created_at', 'updated_at'];

    //Relación de 1 a muchos a la tabla imagenes
    public function images(){
        return $this->hasMany(Images_equip_environment::class,'id','id_equip_environments');
    }
}
