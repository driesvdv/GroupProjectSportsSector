<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     *
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Returns the sportclub this owner belongs to (only for admin purposes)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportclub(): BelongsTo
    {
        return $this->belongsTo(Sportclub::class);
    }

    /**
     * Returns all registrants
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrants(): HasMany
    {
        return $this->hasMany(Registrant::class);
    }
}
