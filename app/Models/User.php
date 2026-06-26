<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'referral_code'];

    protected $hidden = ['password', 'remember_token'];

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
        return $this->hasMany(TrainingRegistration::class);
    }

    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }

    public function voucherTransactions()
    {
        return $this->hasMany(VoucherTransaction::class);
    }

    /**
     * User yang direkrut oleh user ini
     */
    public function downlines(): HasMany
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    /**
     * User yang merekrut user ini
     */
    public function upline(): HasOne
    {
        return $this->hasOne(Referral::class, 'referred_id');
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

    public function isPromotor(): bool
    {
        return $this->role === UserRoleEnum::PROMOTOR;
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
     * Mitra langsung milik Admin
     */
    public function directMitras()
    {
        return $this->downlines()->whereHas('referred', fn($q) => $q->where('role', UserRoleEnum::MITRA));
    }

    /**
     * Promotor langsung milik Admin
     */
    public function directPromotors()
    {
        return $this->downlines()
            ->whereHas(
                'referred',
                fn ($q) => $q->where(
                    'role',
                    UserRoleEnum::PROMOTOR
                )
            );
    }

    /**
     * User yang merekrut user ini
     */
    public function referrerUser(): ?User
    {
        return $this->upline()->with('referrer')->first()?->referrer;
    }

    /**
     * Semua user yang direkrut
     */
    public function referredUsers()
    {
        return $this->downlines()->with('referred');
    }

    /*
    |--------------------------------------------------------------------------
    | Referral Generator
    |--------------------------------------------------------------------------
    */

    public static function generateReferralCode(): string
    {
        do {
            $code = 'STF-' . strtoupper(Str::random(6));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    public function totalNetworkCount(): int
    {
         return $this->downlines()->count();
    }

    public function networkTree(): array
    {
        $tree = [];

        foreach ($this->downlines as $referral) {
            $downline = $referral->referred;

            if (!$downline) {
                continue;
            }

            $children = [];

            foreach ($downline->downlines as $childReferral) {
                if ($childReferral->referred) {
                    $children[] = $childReferral->referred;
                }
            }

            $tree[] = [
                'user' => $downline,
                'children' => $children,
            ];
        }

        return $tree;
    }
}
