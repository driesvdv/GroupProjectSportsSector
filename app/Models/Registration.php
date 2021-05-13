<?php

namespace App\Models;

use Database\Factories\RegistrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function absentSessions()
    {
        return $this->hasMany(AbsentSession::class);
    }

    /**
     * Create a new factory instance for the model
     *
     * @return \Database\Factories\RegistrationFactory
     */
    public static function newFactory(): RegistrationFactory
    {
        return RegistrationFactory::new();
    }
}
