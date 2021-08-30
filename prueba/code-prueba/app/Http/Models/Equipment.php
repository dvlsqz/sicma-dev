<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipments';
    protected $hidden = ['created_at', 'updated_at'];

    public function area(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }

    public function getFiles(){
        return $this->hasMany(EquipmentFile::class,'idequipment','id');
    }

    public function getParts(){
        return $this->hasMany(EquipmentPart::class,'idequipment','id');
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

    public function sup(){
        return $this->hasOne(Supplier::class,'id','idsupplier');
    }

    public function gallery(){
        return $this->hasOne(EquipmentFG::class,'idequipment','id');
    }
}
