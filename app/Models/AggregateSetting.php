<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AggregateSetting extends Model
{
    protected $fillable = [
        'ml_weight',
        'ai_genera_weight',
        'status',
    ];
}
