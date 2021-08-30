<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeDetailProduct extends Model
{
    use HasFactory;

    protected $table = 'incomes_details_products';
    protected $hidden = ['created_at', 'updated_at'];

    public function income(){
        return $this->hasOne(IncomeProduct::class,'id','idincome');
    }

    public function product(){
        return $this->hasOne(Product::class,'id','idproduct');
    }
}
