<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ings7AssignmentArea extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ings7_assignments_areas';
    protected $hidden = ['created_at', 'updated_at'];

    public function area(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
    }
}
