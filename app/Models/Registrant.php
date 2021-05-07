<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $table = 'registrants';

    protected $casts = [
        'birth_date' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'max_registrations'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
