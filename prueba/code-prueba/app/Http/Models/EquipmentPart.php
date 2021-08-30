<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentPart extends Model
{
    use HasFactory;

    protected $table = 'equipment_parts';
    protected $hidden = ['created_at', 'updated_at'];

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','idequipment');
    }
}
