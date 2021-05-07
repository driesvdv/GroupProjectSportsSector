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
        return $this->hasMany(User::class);
    }

    public function sport(){
        return $this->belongsTo(Sport::class);
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }
}
