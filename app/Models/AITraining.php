<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AITraining extends Model
{
    protected $table = 'ai_trainings';

    protected $fillable = [
        'model_ai_id',
        'ai_admin_score',
        'ai_substantive_score',
        'ai_recommendation',
        'user_review',
        'user_admin_score',
        'user_substantive_score',
        'is_trained',
    ];

    public function modelAI()
    {
        return $this->belongsTo(ModelAI::class, 'model_ai_id');
    }
}
