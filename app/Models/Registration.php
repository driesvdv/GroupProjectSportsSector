<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public function registrant(){
        $this->belongsTo(Registrant::class);
    }

    public function group(){
        $this->belongsTo(Group::class);
    }

    public function absentSessions(){
        $this->hasMany(AbsentSession::class);
    }
}
