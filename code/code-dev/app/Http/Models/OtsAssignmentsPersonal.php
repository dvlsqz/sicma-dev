<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtsAssignmentsPersonal extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ots_assignments_personal';
    protected $hidden = ['created_at', 'updated_at'];

    public function ot(){
        return $this->hasOne(Ots::class,'id','idots');
    }
}
