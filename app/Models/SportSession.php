<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function absentSessions(){
        return $this->hasMany(AbsentSession::class);
    }
}
