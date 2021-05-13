<?php

namespace App\Models;

use Database\Factories\sportSessionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SportSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time'
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function absentSessions(): HasMany
    {
        return $this->hasMany(AbsentSession::class);
    }

    public static function newFactory(): sportSessionFactory
    {
        return SportSessionFactory::new();
    }
}
