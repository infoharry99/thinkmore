<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Reflection;
use App\Models\ProgressCheck;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    /**
     * Get scenario case for current day (Days 1 to 60)
     */
    public function todayCase(Request $request)
    {
        $user = $request->user();
        $day = $user->current_day;

        // Fetch exact case for current_day or fallback to matching phase
        $case = CaseStudy::where('is_active', true)
            ->where('day_number', $day)
            ->first();

        if (! $case) {
            // Fallback to active case matching target phase
            $case = CaseStudy::where('is_active', true)
                ->where('phase_target', $user->phase > 0 ? $user->phase : 1)
                ->first();
        }

        if (! $case) {
            return response()->json([
                'status' => 'error',
                'message' => 'No active scenario found for today.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'current_day' => $day,
                'phase' => $user->phase,
                'case' => [
                    'id' => $case->id,
                    'day_number' => $case->day_number,
                    'case_id' => $case->case_id,
                    'domain' => $case->domain,
                    'primary_trap' => $case->primary_trap,
                    'secondary_trap' => $case->secondary_trap,
                    'difficulty' => $case->difficulty,
                    'primary_skill' => $case->primary_skill,
                    'mission' => $case->mission,
                    'learning_objective' => $case->learning_objective,
                    'phase_target' => $case->phase_target,
                    'opening_scenario' => $case->opening_scenario,
                    'step1_detect' => $case->step1_detect,
                    'step2_decode' => $case->step2_decode,
                    'step3_reality_check' => $case->step3_reality_check,
                    'step4_reframe' => $case->step4_reframe,
                    'step5_intervention' => $case->step5_intervention,
                    'step6_internalize' => $case->step6_internalize,
                    'closing_reflection' => $case->closing_reflection,
                    'developer_notes' => $case->developer_notes,
                ]
            ]
        ]);
    }

    /**
     * Submit Day Reflection (Minimal retention rule: only 1-line internalize principle saved)
     */
    public function submitReflection(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|exists:cases,id',
            'internalize_text' => 'required|string|max:280',
        ]);

        $user = $request->user();

        $reflection = Reflection::create([
            'user_id' => $user->id,
            'case_id' => $validated['case_id'],
            'day_number' => $user->current_day,
            'internalize_text' => $validated['internalize_text'],
            'submitted_at' => now(),
        ]);

        // Increment user's day progress
        if ($user->current_day < 60) {
            $user->increment('current_day');
            
            // Phase progression logic: Days 2-20 (Phase 1), Days 21-40 (Phase 2), Days 41-60 (Phase 3)
            if ($user->current_day >= 41) {
                $user->update(['phase' => 3]);
            } elseif ($user->current_day >= 21) {
                $user->update(['phase' => 2]);
            } elseif ($user->current_day >= 2) {
                $user->update(['phase' => 1]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Reflection recorded successfully.',
            'data' => [
                'reflection' => $reflection,
                'next_day' => $user->current_day,
                'phase' => $user->phase,
            ]
        ]);
    }
}
