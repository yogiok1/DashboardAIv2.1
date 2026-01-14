<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProposalGroup;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProposalWithEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $admin = User::where('email', 'admin@admin.app')->orWhere('email', 'admin@example.com')->first();

        if (!$admin) {
            // Use first available user
            $admin = User::first();
        }

        if (!$admin) {
            $this->command->error('No user found. Please create a user first.');
            return;
        }

        // Create dummy proposal groups
        $groups = [
            [
                'group_code' => 'GRP-2025-001',
                'group_name' => 'Penelitian Fundamental 2025',
                'scheme' => 'Penelitian Fundamental',
                'type' => 'current',
                'path' => 'training',
                'total_files' => 5,
                'uploaded_at' => Carbon::now()->subDays(10),
                'status' => 'uploaded',
            ],
            [
                'group_code' => 'GRP-2025-002',
                'group_name' => 'Penelitian Terapan 2025',
                'scheme' => 'Penelitian Terapan',
                'type' => 'current',
                'path' => 'test',
                'total_files' => 3,
                'uploaded_at' => Carbon::now()->subDays(5),
                'status' => 'uploaded',
            ],
        ];

        foreach ($groups as $groupData) {
            $group = ProposalGroup::create($groupData);

            // Create dummy proposals for each group
            $proposalCount = $groupData['total_files'];

            for ($i = 1; $i <= $proposalCount; $i++) {
                $evaluationStatuses = ['belum_dinilai', 'sudah_dinilai_ai', 'sudah_dinilai_reviewer'];
                $status = $evaluationStatuses[array_rand($evaluationStatuses)];

                $proposal = Proposal::create([
                    'proposal_group_id' => $group->id,
                    'user_id' => $admin->id,
                    'group_code' => $group->group_code,
                    'filename' => "Proposal_{$group->group_code}_{$i}.pdf",
                    'path' => "proposals/{$group->group_code}/Proposal_{$i}.pdf",
                    'size' => rand(500000, 2000000), // 500KB - 2MB
                    'status' => 'uploaded',
                    'evaluation_status' => $status,
                    'ai_score' => $status !== 'belum_dinilai' ? rand(60, 95) + (rand(0, 99) / 100) : null,
                    'ml_score' => $status !== 'belum_dinilai' ? rand(65, 98) + (rand(0, 99) / 100) : null,
                    'ai_notes' => $status !== 'belum_dinilai' ? 'Proposal memiliki struktur yang baik dan metodologi yang jelas. Namun perlu perbaikan pada bagian literature review dan justifikasi penelitian.' : null,
                    'reviewer_score' => $status === 'sudah_dinilai_reviewer' ? rand(70, 95) + (rand(0, 99) / 100) : null,
                    'reviewer_notes' => $status === 'sudah_dinilai_reviewer' ? 'Proposal sudah cukup baik. Disarankan untuk memperjelas tujuan penelitian dan menambahkan referensi terbaru.' : null,
                ]);

                $this->command->info("Created proposal: {$proposal->filename} (Status: {$status})");
            }

            $this->command->info("Created group: {$group->group_name} with {$proposalCount} proposals");
        }

        $this->command->info('Dummy proposal data with evaluations created successfully!');
    }
}
