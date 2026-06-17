<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relationship\BelongsTo;
use App\Enums\RegistrationStatusEnum;

class TrainingRegistration extends Model
{
    protected $fillable = ['user_id', 'training_id', 'status'];
    protected function casts(): array
    {
        return ['status' => RegistrationStatusEnum::class];
    }

    //relationship
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
