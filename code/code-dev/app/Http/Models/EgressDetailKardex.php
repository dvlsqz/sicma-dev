<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgressDetailKardex extends Model
{
    use HasFactory;

    protected $table = 'egress_details_kardex';
    protected $hidden = ['created_at', 'updated_at'];

    public function egress(){
        return $this->hasOne(EgressKardex::class,'id','idegress');
    }

    public function kardex(){
        return $this->hasOne(Kardex::class,'id','idproduct');
    }
}
