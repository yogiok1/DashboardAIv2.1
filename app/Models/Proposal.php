<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'size',
        'group_code',
        'proposal_group_id',
        'status',
        'user_id',
        'evaluation_status',
        'assessment_status',
        'ai_score',
        'ml_result',
        'ai_notes',
        'reviewer_score',
        'reviewer_notes',
        'json_result',
        'manual_json',
        'evaluation_id',
        'evaluator_username',
        'evaluation_start_time',
        'processing_time',
        'admin_score',
        'admin_status',
        'substansi_score',
        'substansi_max_score',
        'substansi_min_score',
        'substansi_summary',
    ];

    protected $casts = [
        'assessment_status' => 'integer',
        'json_result' => 'array',
        'manual_json' => 'array',
    ];

    public function group()
    {
        return $this->belongsTo(ProposalGroup::class, 'proposal_group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
