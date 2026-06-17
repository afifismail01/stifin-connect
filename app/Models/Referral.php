<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    protected $fillable = [
        'referrer_id',
        'referred_id',
    ];

    /**
     * User yang merekrut
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'referrer_id'
        );
    }

    /**
     * User yang direkrut
     */
    public function referred(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'referred_id'
        );
    }
}