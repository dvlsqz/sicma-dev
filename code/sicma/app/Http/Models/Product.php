<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $hidden = ['created_at', 'updated_at'];

    public function details_income(){
        return $this->hasOne(IncomeDetailProduct::class,'idproduct','id');
    }
}
