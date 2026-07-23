<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\FoundationFeedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard Overview & Analytics
     */
    public function dashboard()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'total_users' => User::where('role', 'user')->count(),
                'active_cases' => CaseStudy::where('is_active', true)->count(),
                'feedbacks_count' => FoundationFeedback::count(),
                'avg_judgment_impact' => round(FoundationFeedback::avg('judgment_impact_score') ?? 0, 2),
                'avg_recommendation' => round(FoundationFeedback::avg('recommend_score') ?? 0, 2),
                'latest_testimonials' => FoundationFeedback::whereNotNull('testimonial_text')
                    ->latest()
                    ->take(5)
                    ->get(),
            ]
        ]);
    }

    /**
     * List all cases
     */
    public function listCases()
    {
        $cases = CaseStudy::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $cases
        ]);
    }

    /**
     * Store new case in case library
     */
    public function createCase(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|string|unique:cases,case_id',
            'domain' => 'required|string',
            'phase_target' => 'required|integer|between:1,3',
            'trap_target' => 'required|array',
            'opening_scenario' => 'required|string',
            'step1_detect' => 'nullable|array',
            'step2_decode' => 'nullable|array',
            'step3_reality_check' => 'nullable|array',
            'step4_reframe' => 'nullable|array',
            'step5_intervention' => 'nullable|array',
            'step6_internalize' => 'nullable|array',
        ]);

        $case = CaseStudy::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'New case created successfully.',
            'data' => $case
        ], 201);
    }
}
