<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentSession extends Model
{
    use HasFactory;

    public function registration(){
        $this->belongsTo(Registration::class);
    }
    public function sportSession(){
        $this->belongsTo(SportSession::class);
    }
}
