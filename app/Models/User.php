<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'referral_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRoleEnum::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function trainingRegistrations(): HasMany
    {
        return $this->hasMany(
            TrainingRegistration::class
        );
    }

    public function points(): HasMany
    {
        return $this->hasMany(
            Point::class
        );
    }

    /**
     * User yang direkrut oleh user ini
     */
    public function downlines(): HasMany
    {
        return $this->hasMany(
            Referral::class,
            'referrer_id'
        );
    }

    /**
     * User yang merekrut user ini
     */
    public function upline(): HasOne
    {
        return $this->hasOne(
            Referral::class,
            'referred_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin(): bool
    {
        return $this->role === UserRoleEnum::SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRoleEnum::ADMIN;
    }

    public function isMitra(): bool
    {
        return $this->role === UserRoleEnum::MITRA;
    }

    public function isPeserta(): bool
    {
        return $this->role === UserRoleEnum::PESERTA;
    }

    /*
    |--------------------------------------------------------------------------
    | Referral Helpers
    |--------------------------------------------------------------------------
    */

    public function referralsCount(): int
    {
        return $this->downlines()->count();
    }

    public function totalPoints(): float
    {
        return (float) $this->points()->sum('points');
    }

    /**
     * Ambil user yang merekrut user ini
     */
    public function referrerUser(): ?User
    {
        return $this->upline?->referrer;
    }

    /**
     * Ambil semua user yang direkrut user ini
     */
    public function referredUsers()
    {
        return $this->downlines()
            ->with('referred');
    }

    /*
    |--------------------------------------------------------------------------
    | Referral Generator
    |--------------------------------------------------------------------------
    */

    public static function generateReferralCode(): string
    {
        do {
            $code = 'STF-' . strtoupper(
                Str::random(6)
            );
        } while (
            self::where(
                'referral_code',
                $code
            )->exists()
        );

        return $code;
    }
}