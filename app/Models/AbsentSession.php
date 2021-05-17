<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsentSession extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Return the registration of an absentsession
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Return the sportSession of absent sessions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportSession(): BelongsTo
    {
        return $this->belongsTo(SportSession::class);
    }
}
