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
     * Get scenario case for current day
     */
    public function todayCase(Request $request)
    {
        $user = $request->user();
        $day = $user->current_day;

        // Fetch active case for this day or fallback to latest case
        $case = CaseStudy::where('is_active', true)
            ->where(function ($query) use ($user) {
                $query->where('phase_target', $user->phase)
                      ->orWhere('phase_target', 1);
            })
            ->first();

        if (! $case) {
            return response()->json([
                'status' => 'error',
                'message' => 'No active scenario found for today.',
            ], 444);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'current_day' => $day,
                'phase' => $user->phase,
                'case' => $case,
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
