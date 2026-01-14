<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'rubric_name',
        'file_path',
        'file_path_2',
        'schema_id',
    ];

    public function schema()
    {
        return $this->belongsTo(Schema::class);
    }
}
