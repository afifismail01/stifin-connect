<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relationship\BelongsTo;

class Payment extends Model
{
    protected $fillable = ['amount', 'status', 'payment_method', 'transaction_id', 'paid_at', 'training_registration_id'];
    protected function cast(): array
    {
        return ['status' => PaymentStatusEnum::class];
    }

    // Relationship
    public function trainingRegistration(): BelongsTo
    {
        return $this->BelongsTo(TrainingRegistration::class);
    }
}
