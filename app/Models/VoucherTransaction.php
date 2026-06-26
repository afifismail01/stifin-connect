<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherTransaction extends Model
{
    protected $fillable = ['user_id', 'voucher_qty', 'total_amount', 'transaction_date', 'notes', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        // transaksi pembelian voucher dilayani oleh admin X
        return $this->belongsTo(User::class);
    }
}
