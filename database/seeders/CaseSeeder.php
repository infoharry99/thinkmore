<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseStudy;

class CaseSeeder extends Seeder
{
    /**
     * Run database seeders with reference cases from PDF 2 FRD Section 4.1
     */
    public function run(): void
    {
        CaseStudy::create([
            'case_id' => 'P1-001',
            'domain' => 'Relationships/Family',
            'phase_target' => 1,
            'trap_target' => ['Mind Reading', 'Emotional Reasoning'],
            'opening_scenario' => 'Rohan gets home from work, says a quick "hi," goes to the bedroom, and doesn\'t say much through dinner. His wife, Priya, notices he\'s been unusually quiet for two hours.',
            'step1_detect' => [
                'fact' => 'Rohan said little for about two hours after coming home.',
                'story' => 'He\'s upset with me. Something\'s wrong between us.',
                'prompt' => 'Before you go further — write the fact in one line, and the story in one line. Keep them separate.'
            ],
            'step2_decode' => [
                'trap' => 'Mind Reading + Emotional Reasoning',
                'explanation' => 'Assuming his internal state and treating her own anxiety as proof something is wrong, with no direct evidence from him.'
            ],
            'step3_reality_check' => [
                'q1' => 'Is quietness after work normal for him on some days, or is this new?',
                'q2' => 'What happened today that has nothing to do with her — deadlines, traffic, a hard conversation at work?',
                'q3' => 'Has he actually said or done anything pointed at her, or is this silence alone?',
                'q4' => 'If a friend described this exact scene, would she assume the same thing about their marriage?',
                'q5' => 'What\'s the actual evidence he\'s upset with her, versus just upset, tired, or elsewhere in his head?'
            ],
            'step4_reframe' => [
                'option1' => 'He had a rough day at work and is decompressing — nothing to do with her.',
                'option2' => 'He\'s mentally stuck on a problem (a deadline, a difficult colleague) and hasn\'t switched contexts yet.',
                'option3' => 'He\'s tired and quiet is just his low-energy default, not a signal.',
                'option4' => 'Something is bothering him, but it may be unrelated to the relationship — and he hasn\'t found words for it yet.'
            ],
            'step5_intervention' => [
                'action' => 'Instead of asking "What\'s wrong with you?" or withdrawing herself, she says one low-pressure line: "You\'ve been quiet — long day?" — then gives him room to answer without pressing further.',
                'rationale' => 'A single low-stakes opener invites disclosure without triggering defensiveness.'
            ],
            'step6_internalize' => [
                'principle' => 'Silence is not a message. It\'s a blank I fill in — check before I fill it with the worst option.'
            ],
            'is_active' => true,
        ]);
    }
}
