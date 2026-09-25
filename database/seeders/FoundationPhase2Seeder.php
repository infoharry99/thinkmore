<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoundationDay;
use App\Models\CaseStudy;
use Illuminate\Support\Facades\File;

class FoundationPhase2Seeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('data/phase2_seed_data.json');
        
        if (!File::exists($jsonPath)) {
            $this->command?->error("Phase 2 seed file not found at: {$jsonPath}");
            return;
        }

        $days = json_decode(File::get($jsonPath), true);

        if (!is_array($days)) {
            $this->command?->error("Invalid JSON data in phase2_seed_data.json");
            return;
        }

        foreach ($days as $dayData) {
            $dayNumber = $dayData['day'];

            // 1. Seed into foundation_days table
            FoundationDay::updateOrCreate(
                ['day_number' => $dayNumber],
                [
                    'phase' => $dayData['phase'] ?? 2,
                    'title' => $dayData['title'] ?? '',
                    'domain' => $dayData['domain'] ?? '',
                    'primary_trap' => $dayData['primary_trap'] ?? null,
                    'secondary_trap' => $dayData['secondary_trap'] ?? null,
                    'content_bundle' => $dayData,
                ]
            );

            // 2. Also seed/sync into cases table for legacy admin view compatibility
            $caseId = sprintf('P2-%03d', $dayNumber);
            $detectStep = collect($dayData['steps'] ?? [])->firstWhere('key', 'detect');
            $decodeStep = collect($dayData['steps'] ?? [])->firstWhere('key', 'decode');
            $interventionStep = collect($dayData['steps'] ?? [])->firstWhere('key', 'intervention');
            $internalizeStep = collect($dayData['steps'] ?? [])->firstWhere('key', 'internalize');

            CaseStudy::updateOrCreate(
                ['day_number' => $dayNumber],
                [
                    'case_id' => $caseId,
                    'domain' => $dayData['domain'] ?? '',
                    'phase_target' => $dayData['phase'] ?? 2,
                    'primary_trap' => $dayData['primary_trap'] ?? null,
                    'secondary_trap' => $dayData['secondary_trap'] ?? null,
                    'difficulty' => $dayData['difficulty'] ?? 'Intermediate',
                    'primary_skill' => $dayData['primary_skill'] ?? 'Detect',
                    'mission' => $dayData['mission'] ?? '',
                    'learning_objective' => $dayData['learning_objective'] ?? '',
                    'trap_target' => array_filter([$dayData['primary_trap'] ?? null, $dayData['secondary_trap'] ?? null]),
                    'opening_scenario' => $dayData['scenario_text'] ?? '',
                    'step1_detect' => $detectStep,
                    'step2_decode' => $decodeStep,
                    'step5_intervention' => $interventionStep,
                    'step6_internalize' => $internalizeStep,
                    'closing_reflection' => $dayData['closing_reflection']['prompt'] ?? null,
                    'is_active' => true,
                ]
            );
        }

        $this->command?->info("Successfully seeded all 20 Phase 2 Foundation Program days (Days 21–40)!");
    }
}
