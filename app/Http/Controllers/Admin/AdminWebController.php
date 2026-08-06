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
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $userQuery = function($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        };

        $stats = [
            'total_users' => User::where($userQuery)->count(),
            'active_cases' => CaseStudy::where('is_active', true)->count(),
            'total_feedbacks' => FoundationFeedback::count(),
            'avg_impact_score' => round(FoundationFeedback::avg('judgment_impact_score') ?? 0, 1),
            'avg_recommend_score' => round(FoundationFeedback::avg('recommend_score') ?? 0, 1),
        ];

        $recentFeedbacks = FoundationFeedback::with('user')
            ->latest()
            ->take(6)
            ->get();

        $recentUsers = User::where($userQuery)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentFeedbacks', 'recentUsers'));
    }

    public function casesIndex()
    {
        $cases = CaseStudy::orderBy('day_number', 'asc')->paginate(20);
        return view('admin.cases.index', compact('cases'));
    }

    public function casesCreate()
    {
        return view('admin.cases.create');
    }

    public function casesStore(Request $request)
    {
        $validated = $request->validate([
            'day_number' => 'required|integer|between:1,60|unique:cases,day_number',
            'case_id' => 'required|string|unique:cases,case_id',
            'domain' => 'required|string',
            'primary_trap' => 'required|string',
            'difficulty' => 'required|string',
            'primary_skill' => 'required|string',
            'mission' => 'required|string',
            'learning_objective' => 'required|string',
            'phase_target' => 'required|integer|between:1,3',
            'opening_scenario' => 'required|string',
            'fact_line' => 'required|string',
            'story_line' => 'required|string',
            'trap_explanation' => 'required|string',
            'action_text' => 'required|string',
            'internalize_principle' => 'required|string',
            'closing_reflection' => 'nullable|string',
        ]);

        CaseStudy::create([
            'day_number' => $validated['day_number'],
            'case_id' => $validated['case_id'],
            'domain' => $validated['domain'],
            'primary_trap' => $validated['primary_trap'],
            'difficulty' => $validated['difficulty'],
            'primary_skill' => $validated['primary_skill'],
            'mission' => $validated['mission'],
            'learning_objective' => $validated['learning_objective'],
            'phase_target' => $validated['phase_target'],
            'trap_target' => [$validated['primary_trap']],
            'opening_scenario' => $validated['opening_scenario'],
            'step1_detect' => [
                'fact_prompt' => 'Write only the facts.',
                'story_prompt' => 'Now write the story your mind is creating.',
                'model_fact' => $validated['fact_line'],
                'model_story' => $validated['story_line'],
            ],
            'step2_decode' => [
                'correct_trap' => $validated['primary_trap'],
                'explanation' => $validated['trap_explanation'],
            ],
            'step5_intervention' => [
                'model_action' => $validated['action_text'],
            ],
            'step6_internalize' => [
                'model_principle' => $validated['internalize_principle'],
            ],
            'closing_reflection' => $validated['closing_reflection'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('admin.cases.index')->with('success', 'New Day Case Study created successfully!');
    }

    public function casesEdit($id)
    {
        $case = CaseStudy::findOrFail($id);
        return view('admin.cases.edit', compact('case'));
    }

    public function casesPreview($id)
    {
        $case = CaseStudy::findOrFail($id);
        return view('admin.cases.preview', compact('case'));
    }

    public function casesUpdate(Request $request, $id)
    {
        $case = CaseStudy::findOrFail($id);

        $validated = $request->validate([
            'day_number' => 'required|integer|between:1,60',
            'domain' => 'required|string',
            'primary_trap' => 'required|string',
            'difficulty' => 'required|string',
            'primary_skill' => 'required|string',
            'mission' => 'required|string',
            'learning_objective' => 'required|string',
            'phase_target' => 'required|integer|between:1,3',
            'opening_scenario' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $case->update($validated);

        return redirect()->route('admin.cases.index')->with('success', 'Case study updated successfully!');
    }

    public function feedbacksIndex(Request $request)
    {
        $query = FoundationFeedback::with('user')->latest();

        if ($request->has('score') && $request->score !== null) {
            $query->where('judgment_impact_score', $request->score);
        }

        $feedbacks = $query->paginate(15);
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function usersIndex()
    {
        $users = User::where(function($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }
}
