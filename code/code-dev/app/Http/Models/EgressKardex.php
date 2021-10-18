<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgressKardex extends Model
{
    use HasFactory;

    protected $table = 'egress_kardex';
    protected $hidden = ['created_at', 'updated_at'];

    public function ma(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }

    public function user(){
        return $this->hasOne(User::class,'id','idaccountable');
    }

    public function ing7(){
        return $this->hasOne(Ings7::class, 'id', 'iding7');
    }

    public function ot(){
        return $this->hasOne(Ots::class, 'id', 'idot');
    }

    public function details(){
        return $this->hasOne(EgressDetailKardex::class,'idegress','id');
    }
}
