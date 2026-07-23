<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\FoundationFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminWebController extends Controller
{
    /**
     * Show Admin Login Form
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Handle Admin Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. You do not have admin permissions.']);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle Admin Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'active_cases' => CaseStudy::where('is_active', true)->count(),
            'total_feedbacks' => FoundationFeedback::count(),
            'avg_impact_score' => round(FoundationFeedback::avg('judgment_impact_score') ?? 0, 1),
            'avg_recommend_score' => round(FoundationFeedback::avg('recommend_score') ?? 0, 1),
        ];

        $recentFeedbacks = FoundationFeedback::with('user')
            ->latest()
            ->take(6)
            ->get();

        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentFeedbacks', 'recentUsers'));
    }

    /**
     * Cases List
     */
    public function casesIndex()
    {
        $cases = CaseStudy::latest()->paginate(15);
        return view('admin.cases.index', compact('cases'));
    }

    /**
     * Create Case View
     */
    public function casesCreate()
    {
        return view('admin.cases.create');
    }

    /**
     * Store Case Logic
     */
    public function casesStore(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|string|unique:cases,case_id',
            'domain' => 'required|string',
            'phase_target' => 'required|integer|between:1,3',
            'opening_scenario' => 'required|string',
            'fact_line' => 'required|string',
            'story_line' => 'required|string',
            'trap_name' => 'required|string',
            'trap_explanation' => 'required|string',
            'action_text' => 'required|string',
            'internalize_principle' => 'required|string',
        ]);

        CaseStudy::create([
            'case_id' => $validated['case_id'],
            'domain' => $validated['domain'],
            'phase_target' => $validated['phase_target'],
            'trap_target' => [$validated['trap_name']],
            'opening_scenario' => $validated['opening_scenario'],
            'step1_detect' => [
                'fact' => $validated['fact_line'],
                'story' => $validated['story_line'],
            ],
            'step2_decode' => [
                'trap' => $validated['trap_name'],
                'explanation' => $validated['trap_explanation'],
            ],
            'step5_intervention' => [
                'action' => $validated['action_text'],
            ],
            'step6_internalize' => [
                'principle' => $validated['internalize_principle'],
            ],
            'is_active' => true,
        ]);

        return redirect()->route('admin.cases.index')->with('success', 'Case study created successfully!');
    }

    /**
     * Edit Case View
     */
    public function casesEdit($id)
    {
        $case = CaseStudy::findOrFail($id);
        return view('admin.cases.edit', compact('case'));
    }

    /**
     * Update Case Logic
     */
    public function casesUpdate(Request $request, $id)
    {
        $case = CaseStudy::findOrFail($id);

        $validated = $request->validate([
            'domain' => 'required|string',
            'phase_target' => 'required|integer|between:1,3',
            'opening_scenario' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $case->update([
            'domain' => $validated['domain'],
            'phase_target' => $validated['phase_target'],
            'opening_scenario' => $validated['opening_scenario'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.cases.index')->with('success', 'Case updated successfully!');
    }

    /**
     * 60-Day Foundation Feedbacks Report (PDF 1 Spec)
     */
    public function feedbacksIndex(Request $request)
    {
        $query = FoundationFeedback::with('user')->latest();

        if ($request->has('score') && $request->score !== null) {
            $query->where('judgment_impact_score', $request->score);
        }

        $feedbacks = $query->paginate(15);
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Users & Progress Tracking List
     */
    public function usersIndex()
    {
        $users = User::where('role', 'user')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }
}
