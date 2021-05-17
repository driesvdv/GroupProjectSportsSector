<?php

namespace App\Models;

use Database\Factories\RegistrantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $table = 'registrants';

    protected $casts = [
        'birth_date' => 'datetime:Y/m/d',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'max_registrations'
    ];

    protected $appends = ['full_name'];


    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public static function newFactory(): RegistrantFactory
    {
        return RegistrantFactory::new();
    }
}
