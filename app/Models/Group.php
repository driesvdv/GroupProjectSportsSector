<?php

namespace App\Models;

use Database\Factories\groupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'time',
        'max_members',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function sportclub()
    {
        return $this->belongsTo(Sportclub::class);
    }

    public function sportSessions()
    {
        return $this->hasMany(SportSession::class);
    }

    public static function newFactory(): groupFactory
    {
        return groupFactory::new();
    }
}
