<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalGroup extends Model
{
    protected $fillable = [
        'group_code',
        'group_name',
        'scheme',
        'type',
        'total_files',
        'uploaded_at',
        'status',
        'assessment_type',
        'path',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function results()
    {
        return $this->hasMany(ProposalGroupResult::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'proposal_group_id', 'id');
    }
}
