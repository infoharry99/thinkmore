<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoundationDay;
use App\Models\FoundationResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoundationController extends Controller
{
    /**
     * 2.1 Get Day Content
     * GET /api/v1/foundation/phase1/days/{day_number}
     */
    public function getDayContent($day_number)
    {
        $dayNumber = (int) $day_number;

        $foundationDay = FoundationDay::where('day_number', $dayNumber)->first();

        if (!$foundationDay) {
            return response()->json([
                'message' => "Day {$dayNumber} content not found."
            ], 404);
        }

        return response()->json($foundationDay->content_bundle, 200);
    }

    /**
     * 2.2 Submit Day Responses
     * POST /api/v1/foundation/phase1/days/{day_number}/responses
     */
    public function submitDayResponses(Request $request, $day_number)
    {
        $dayNumber = (int) $day_number;
        $user = Auth::user();

        $request->validate([
            'responses' => 'required',
            'input_method' => 'nullable|string',
            'started_at' => 'nullable',
            'completed_at' => 'nullable',
        ]);

        $foundationDay = FoundationDay::where('day_number', $dayNumber)->first();

        if (!$foundationDay) {
            return response()->json([
                'message' => "Day {$dayNumber} curriculum content not found."
            ], 404);
        }

        // Save or update user response
        $response = FoundationResponse::updateOrCreate(
            [
                'user_id' => $user->id,
                'day_number' => $dayNumber,
            ],
            [
                'phase' => $foundationDay->phase ?? 1,
                'responses' => $request->responses,
                'input_method' => $request->input_method ?? 'typed',
                'started_at' => $request->started_at ?? now(),
                'completed_at' => $request->completed_at ?? now(),
                'status' => 'completed',
            ]
        );

        // Advance user progress if user completes current day
        if ($user->current_day <= $dayNumber) {
            $user->current_day = $dayNumber + 1;
            if ($user->phase === 0) {
                $user->phase = 1;
            }
            $user->save();
        }

        $bundle = $foundationDay->content_bundle;
        $decodeStep = collect($bundle['steps'] ?? [])->firstWhere('key', 'decode');
        
        // Extract selected option from responses object (supports flat "decode.selected_option" or nested responses)
        $responsesRaw = $request->responses;
        $selectedOption = null;

        if (is_array($responsesRaw)) {
            $selectedOption = $responsesRaw['decode.selected_option'] 
                ?? $responsesRaw['decode']['selected_option'] 
                ?? null;
        }

        $correctOptionKey = $decodeStep['correct_option_key'] ?? null;
        $explanation = $decodeStep['explanation'] ?? '';

        $isCorrect = null;
        if ($correctOptionKey !== null) {
            $isCorrect = ($selectedOption === $correctOptionKey);
        }

        $unlockedNextDay = $dayNumber + 1;

        // For Day 20 (or when end_of_day_walkthrough exists in day bundle), return walkthrough
        if ($dayNumber == 20 || isset($bundle['end_of_day_walkthrough'])) {
            return response()->json([
                'day' => $dayNumber,
                'status' => 'completed',
                'end_of_day_walkthrough' => $bundle['end_of_day_walkthrough'] ?? null,
                'unlocked_next_day' => $unlockedNextDay,
            ], 200);
        }

        return response()->json([
            'day' => $dayNumber,
            'status' => 'completed',
            'decode_result' => [
                'selected_option' => $selectedOption,
                'is_correct' => $isCorrect,
                'explanation' => $explanation,
            ],
            'unlocked_next_day' => $unlockedNextDay,
        ], 200);
    }

    /**
     * 2.3 Get Saved Responses
     * GET /api/v1/foundation/phase1/days/{day_number}/responses
     */
    public function getSavedResponses($day_number)
    {
        $dayNumber = (int) $day_number;
        $user = Auth::user();

        $savedResponse = FoundationResponse::where('user_id', $user->id)
            ->where('day_number', $dayNumber)
            ->first();

        if (!$savedResponse) {
            return response()->json([
                'day' => $dayNumber,
                'status' => 'not_started',
                'responses' => null,
                'input_method' => null,
                'started_at' => null,
                'completed_at' => null,
            ], 200);
        }

        return response()->json([
            'day' => $dayNumber,
            'status' => $savedResponse->status,
            'responses' => $savedResponse->responses,
            'input_method' => $savedResponse->input_method,
            'started_at' => $savedResponse->started_at ? $savedResponse->started_at->toISOString() : null,
            'completed_at' => $savedResponse->completed_at ? $savedResponse->completed_at->toISOString() : null,
        ], 200);
    }

    /**
     * 2.4 Get Progress / Unlock State
     * GET /api/v1/foundation/progress
     */
    public function getProgress()
    {
        $user = Auth::user();

        $completedDays = FoundationResponse::where('user_id', $user->id)
            ->where('status', 'completed')
            ->pluck('day_number')
            ->map(fn($d) => (int) $d)
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $phase1Completed = count(array_intersect(range(1, 20), $completedDays)) === 20;

        return response()->json([
            'day0_completed' => (bool) ($user->day0_completed ?? true),
            'current_phase' => $user->phase == 0 ? 1 : (int) $user->phase,
            'current_day' => (int) $user->current_day,
            'completed_days' => $completedDays,
            'phase1_completed' => $phase1Completed,
        ], 200);
    }
}
