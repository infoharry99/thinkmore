<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoundationFeedback;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FoundationFeedbackController extends Controller
{
    /**
     * Submit Foundation Course Feedback Survey (PDF 1 Spec)
     * Trigger: On completion of 60-day Foundation Program
     */
    public function store(Request $request)
    {
        $user = $request->user();

        // Check if user already submitted feedback
        $existing = FoundationFeedback::where('user_id', $user->id)->first();
        if ($existing) {
            return response()->json([
                'status' => 'error',
                'message' => 'Feedback survey already submitted.',
                'data' => $existing,
            ], 400);
        }

        // Validate payload according to PDF 1 Data Fields spec
        $validated = $request->validate([
            'judgment_impact_score' => 'required|integer|between:1,5',
            'technique_applied' => [
                'required',
                Rule::in(['multiple', 'once_or_twice', 'not_yet', 'dont_remember'])
            ],
            'recommend_score' => 'required|integer|between:1,5',
            'testimonial_text' => 'nullable|string|max:280',
            'improvement_feedback' => 'nullable|string|max:280',
        ]);

        // Create feedback record
        $feedback = FoundationFeedback::create([
            'user_id' => $user->id,
            'judgment_impact_score' => $validated['judgment_impact_score'],
            'technique_applied' => $validated['technique_applied'],
            'recommend_score' => $validated['recommend_score'],
            // Conditional field A (saved if impact >= 4)
            'testimonial_text' => ($validated['judgment_impact_score'] >= 4)
                ? ($validated['testimonial_text'] ?? null)
                : null,
            // Conditional field B (saved if impact <= 2)
            'improvement_feedback' => ($validated['judgment_impact_score'] <= 2)
                ? ($validated['improvement_feedback'] ?? null)
                : null,
            'submitted_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for your feedback. It helps us keep improving ThinkClear.',
            'data' => $feedback,
        ], 201);
    }

    /**
     * Check if user has completed feedback
     */
    public function checkSubmitted(Request $request)
    {
        $user = $request->user();
        $submitted = FoundationFeedback::where('user_id', $user->id)->exists();

        return response()->json([
            'status' => 'success',
            'data' => [
                'has_submitted' => $submitted,
                'can_trigger' => ($user->current_day >= 60 && !$submitted),
            ]
        ]);
    }
}
