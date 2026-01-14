<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $fillable = [
        'name',
        'description',
        'schema_data',
        'type',
    ];

    protected $casts = [
        'schema_data' => 'array',
    ];
}
