<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtsFG extends Model
{
    use HasFactory;

    protected $table = 'ots_files_gallery';
    protected $hidden = ['created_at', 'updated_at'];

    public function ot(){
        return $this->hasOne(Ots::class,'id','idots');
    }
}
