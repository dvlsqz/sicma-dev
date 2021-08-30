<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DabFr extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'dab_fr';
    protected $hidden = ['created_at', 'updated_at'];

    public function area(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }
}
