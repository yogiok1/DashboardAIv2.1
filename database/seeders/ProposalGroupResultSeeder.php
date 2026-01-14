<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProposalGroup;
use App\Models\ProposalGroupResult;

class ProposalGroupResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = ProposalGroup::all();

        foreach ($groups as $group) {
            // Calculate totals from actual proposals
            $totalProposals = $group->proposals->count();

            // Random distribution of results
            $accepted = rand(floor($totalProposals * 0.3), floor($totalProposals * 0.7));
            $rejected = rand(0, floor(($totalProposals - $accepted) * 0.6));
            $others = $totalProposals - $accepted - $rejected;

            ProposalGroupResult::create([
                'proposal_group_id' => $group->id,
                'accepted' => $accepted,
                'rejected' => $rejected,
                'others' => $others,
            ]);

            $this->command->info("Created result for group: {$group->group_name} (Total: {$totalProposals}, Accepted: {$accepted}, Rejected: {$rejected}, Others: {$others})");
        }

        $this->command->info('Proposal group results created successfully!');
    }
}
