<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeProduct extends Model
{
    use HasFactory;

    protected $table = 'incomes_products';
    protected $hidden = ['created_at', 'updated_at'];

    public function supplier(){
        return $this->hasOne(Supplier::class,'id','idsupplier');
    }
}
