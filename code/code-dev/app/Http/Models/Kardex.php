<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kardex extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'kardex_mantto';
    protected $hidden = ['created_at', 'updated_at'];

    public function product(){
        return $this->hasOne(Product::class,'id','idproduct');
    }

    public function area(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }

    
}
