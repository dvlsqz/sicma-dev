<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeDetailKardex extends Model
{
    use HasFactory;

    protected $table = 'incomes_details_kardex';
    protected $hidden = ['created_at', 'updated_at'];

    public function income(){
        return $this->hasOne(IncomeKardex::class,'id','idincome');
    }

    public function kardex(){
        return $this->hasOne(Kardex::class,'id','idproduct');
    }
}
