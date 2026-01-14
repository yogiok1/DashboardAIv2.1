<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalGroupResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_group_id',
        'accepted',
        'rejected',
        'others',
        'notes'
    ];

    public function group()
    {
        return $this->belongsTo(ProposalGroup::class, 'proposal_group_id');
    }
}
