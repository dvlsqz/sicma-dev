<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgressProduct extends Model
{
    use HasFactory;

    protected $table = 'egress_products';
    protected $hidden = ['created_at', 'updated_at'];

    public function ma(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }
}
