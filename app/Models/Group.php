<?php

namespace App\Models;

use Database\Factories\GroupFactory;
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

    protected $appends = ['free_spaces'];

    public function getFreeSpacesAttribute()
    {
        return $this->max_members - $this->registrations()->count();
    }

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

    public static function newFactory(): GroupFactory
    {
        return GroupFactory::new();
    }
}
