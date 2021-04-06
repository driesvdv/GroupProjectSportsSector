<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportclub extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function admins(){
        $this->hasMany(User::class);
    }

    public function sport(){
        $this->belongsTo(Sport::class);
    }

    public function groups(){
        $this->hasMany(Group::class);
    }
}
