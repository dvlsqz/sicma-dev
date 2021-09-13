<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentPart extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'equipment_parts';
    protected $hidden = ['created_at', 'updated_at'];

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','idequipment');
    }
}
