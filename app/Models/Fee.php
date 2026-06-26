<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fee extends Model
{
    protected $fillable = ['user_id', 'source_user_id', 'voucher_transaction_id', 'amount', 'description'];

    public function mitra()
    {
        //penerima fee
        return $this->belongsTo(User::class);
    }

    public function promotor()
    {
        //sumber fee dari promotor X
        return $this->belongsTo(User::class);
    }

    public function voucherTransaction()
    {
        // ref transaksi voucher
        return $this->belongsTo(User::class);
    }
}
