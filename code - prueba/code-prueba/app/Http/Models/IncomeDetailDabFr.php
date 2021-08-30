<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeDetailDabFr extends Model
{
    use HasFactory;

    protected $table = 'dab_fr_details_products';
    protected $hidden = ['created_at', 'updated_at'];

    public function income(){
        return $this->hasOne(DabFr::class,'id','iddab');
    }

    public function product(){
        return $this->hasOne(Product::class,'id','idproduct');
    }
}
