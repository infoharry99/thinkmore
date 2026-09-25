<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoundationDay;
use App\Models\FoundationResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FoundationController extends Controller
{
    /**
     * Get All Curriculum Introductions (App Front Page & Phase Introductions)
     * GET /api/v1/foundation/introductions
     */
    public function getIntroductions()
    {
        $filePath = database_path('data/curriculum_intros.json');
        
        if (!File::exists($filePath)) {
            return response()->json([
                'message' => 'Curriculum introductions not found.'
            ], 404);
        }

        $data = json_decode(File::get($filePath), true);

        return response()->json($data, 200);
    }

    /**
     * Get Specific Phase Introduction
     * GET /api/v1/foundation/phase/{phase_number}/intro
     */
    public function getPhaseIntro($phase_number)
    {
        $phaseNum = (int) $phase_number;
        $filePath = database_path('data/curriculum_intros.json');
        
        if (!File::exists($filePath)) {
            return response()->json([
                'message' => 'Curriculum introductions not found.'
            ], 404);
        }

        $data = json_decode(File::get($filePath), true);
        $key = "phase{$phaseNum}_introduction";

        if (!isset($data[$key])) {
            return response()->json([
                'message' => "Introduction for Phase {$phaseNum} not found."
            ], 404);
        }

        return response()->json($data[$key], 200);
    }

    /**
     * 2.1 Get Day Content (Supports Days 1–40 / Phase 1 & 2)
     * GET /api/v1/foundation/days/{day_number}
     * GET /api/v1/foundation/phase1/days/{day_number}
     * GET /api/v1/foundation/phase2/days/{day_number}
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
     * POST /api/v1/foundation/days/{day_number}/responses
     * POST /api/v1/foundation/phase1/days/{day_number}/responses
     * POST /api/v1/foundation/phase2/days/{day_number}/responses
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

        $dayPhase = $foundationDay->phase ?? ($dayNumber > 20 ? 2 : 1);

        // Save or update user response
        $response = FoundationResponse::updateOrCreate(
            [
                'user_id' => $user->id,
                'day_number' => $dayNumber,
            ],
            [
                'phase' => $dayPhase,
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
            
            // Automatically assign phase dynamically from the next day's database record
            $nextDayRecord = FoundationDay::where('day_number', $user->current_day)->first();
            if ($nextDayRecord) {
                $user->phase = (int) $nextDayRecord->phase;
            } else {
                $user->phase = (int) $dayPhase;
            }
            
            $user->save();
        }

        $bundle = $foundationDay->content_bundle;
        $decodeStep = collect($bundle['steps'] ?? [])->firstWhere('key', 'decode');
        
        // Extract selected option from responses object (supports flat or nested responses)
        $responsesRaw = $request->responses;
        $selectedOption = null;

        if (is_array($responsesRaw)) {
            $selectedOption = $responsesRaw['decode.selected_option'] 
                ?? $responsesRaw['decode']['selected_option'] 
                ?? $responsesRaw['decode']['primary_trap']
                ?? null;
        }

        $correctOptionKey = $decodeStep['correct_option_key'] ?? null;
        $explanation = $decodeStep['explanation'] ?? '';

        $isCorrect = null;
        if ($correctOptionKey !== null && $selectedOption !== null) {
            $isCorrect = ($selectedOption === $correctOptionKey);
        }

        $unlockedNextDay = $dayNumber + 1;

        // Check for Phase 2 End Walkthrough (Day 40)
        if ($dayNumber == 40 || isset($bundle['end_of_phase2_walkthrough'])) {
            return response()->json([
                'day' => $dayNumber,
                'phase' => 2,
                'status' => 'completed',
                'end_of_phase2_walkthrough' => $bundle['end_of_phase2_walkthrough'] ?? [
                    'summary' => 'Congratulations on completing Phase 2: Application (Days 21–40)!',
                    'unlocked_phase' => 3
                ],
                'unlocked_next_day' => $unlockedNextDay,
            ], 200);
        }

        // Check for Phase 1 End Walkthrough (Day 20)
        if ($dayNumber == 20 || isset($bundle['end_of_day_walkthrough'])) {
            return response()->json([
                'day' => $dayNumber,
                'phase' => 1,
                'status' => 'completed',
                'end_of_day_walkthrough' => $bundle['end_of_day_walkthrough'] ?? null,
                'unlocked_next_day' => $unlockedNextDay,
            ], 200);
        }

        return response()->json([
            'day' => $dayNumber,
            'phase' => $dayPhase,
            'status' => 'completed',
            'decode_result' => [
                'selected_option' => $selectedOption,
                'primary_trap' => $decodeStep['primary_trap'] ?? null,
                'secondary_traps' => $decodeStep['secondary_traps'] ?? [],
                'is_correct' => $isCorrect,
                'explanation' => $explanation,
            ],
            'unlocked_next_day' => $unlockedNextDay,
        ], 200);
    }

    /**
     * 2.3 Get Saved Responses
     * GET /api/v1/foundation/days/{day_number}/responses
     * GET /api/v1/foundation/phase1/days/{day_number}/responses
     * GET /api/v1/foundation/phase2/days/{day_number}/responses
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
            'phase' => $savedResponse->phase,
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

        $currentDay = (int) $user->current_day;
        
        // Dynamically determine current phase from database curriculum
        $currentDayRecord = FoundationDay::where('day_number', $currentDay)->first();
        if ($currentDayRecord) {
            $currentPhase = (int) $currentDayRecord->phase;
        } else {
            $lastDay = FoundationDay::orderBy('day_number', 'desc')->first();
            $currentPhase = $lastDay ? (int) $lastDay->phase : (int) ($user->phase ?? 1);
        }

        $totalDaysAvailable = FoundationDay::count();

        // Dynamically compute completion status for all available phases (Phase 1, 2, 3, 4, 5, etc.)
        $phases = FoundationDay::distinct()->pluck('phase')->sort()->values();
        $phasesStatus = [];
        foreach ($phases as $ph) {
            $phDays = FoundationDay::where('phase', $ph)->pluck('day_number')->toArray();
            $phasesStatus["phase{$ph}_completed"] = count($phDays) > 0 && count(array_intersect($phDays, $completedDays)) === count($phDays);
        }

        return response()->json(array_merge([
            'day0_completed' => (bool) ($user->day0_completed ?? true),
            'current_phase' => $currentPhase,
            'current_day' => $currentDay,
            'completed_days' => $completedDays,
            'phase1_completed' => $phasesStatus['phase1_completed'] ?? false,
            'phase2_completed' => $phasesStatus['phase2_completed'] ?? false,
            'total_days_available' => $totalDaysAvailable,
        ], $phasesStatus), 200);
    }
}
