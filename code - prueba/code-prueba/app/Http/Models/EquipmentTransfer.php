<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentTransfer extends Model
{
    use HasFactory;
    protected $table = 'equipment_transfers';
    protected $hidden = ['created_at', 'updated_at'];

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','idequipment');
    }

    public function servicegeneral(){
        return $this->hasOne(Environment::class,'id','idservicegeneral');
    }

    public function service(){
        return $this->hasOne(Environment::class,'id','idservice');
    }

    public function environment(){
        return $this->hasOne(Environment::class,'id','idenvironment');
    }
}
