<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'file_paths' => 'array',
    ];
}
