<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalSource extends Model
{
    protected $fillable = [
        'source_name',
        'file_path',
        'original_filename',
        'file_size',
        'type',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
