<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgressDetailProduct extends Model
{
    use HasFactory;

    protected $table = 'egress_details_products';
    protected $hidden = ['created_at', 'updated_at'];

    public function egress(){
        return $this->hasOne(EgressProduct::class,'id','idegress');
    }

    public function product(){
        return $this->hasOne(Product::class,'id','idproduct');
    }
}
