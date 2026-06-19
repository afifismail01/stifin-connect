<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'training_date',
        'quota',
        'status',
    ];
}
