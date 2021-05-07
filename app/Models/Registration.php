<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function registrant(){
        return $this->belongsTo(Registrant::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function absentSessions(){
        return $this->hasMany(AbsentSession::class);
    }
}
