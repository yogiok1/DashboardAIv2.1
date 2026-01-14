<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAI extends Model
{
    protected $table = 'model_ais';

    protected $fillable = [
        'name',
        'provider',
        'model_code',
        'description',
        'is_active',
    ];
}
