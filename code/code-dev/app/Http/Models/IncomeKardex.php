<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeKardex extends Model
{
    use HasFactory;

    protected $table = 'incomes_kardex';
    protected $hidden = ['created_at', 'updated_at'];

    public function ma(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }

    public function user(){
        return $this->hasOne(User::class,'id','idaccountable');
    }

    public function details(){
        return $this->hasOne(IncomeDetailKardex::class, 'idincome', 'id');
    }
}
