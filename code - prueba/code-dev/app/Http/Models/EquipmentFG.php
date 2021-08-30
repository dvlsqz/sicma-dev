<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentFG extends Model
{
    use HasFactory;

    protected $table = 'equipment_files_gallery';
    protected $hidden = ['created_at', 'updated_at'];

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','idequipment');
    }
}
