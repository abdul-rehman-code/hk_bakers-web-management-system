<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    protected $fillable = [
        'event_type',
        'details',
        'sample_image',
        'weight',
        'status',
    ];
}
