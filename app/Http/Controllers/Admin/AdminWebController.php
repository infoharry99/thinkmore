<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\FoundationDay;
use App\Models\FoundationFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\FoundationPhase1Seeder;

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
            'foundation_days_count' => FoundationDay::count(),
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

    /*
    |--------------------------------------------------------------------------
    | Foundation Program Phase 1 Days Management
    |--------------------------------------------------------------------------
    */

    public function foundationIndex(Request $request)
    {
        $query = FoundationDay::orderBy('day_number', 'asc');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('day_number', 'LIKE', "%{$search}%")
                  ->orWhere('domain', 'LIKE', "%{$search}%")
                  ->orWhere('primary_trap', 'LIKE', "%{$search}%")
                  ->orWhere('primary_skill', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        if ($request->filled('trap')) {
            $query->where('primary_trap', $request->trap);
        }

        $days = $query->paginate(15)->withQueryString();

        $domains = FoundationDay::distinct()->pluck('domain')->filter();
        $traps = FoundationDay::distinct()->pluck('primary_trap')->filter();

        return view('admin.foundation.index', compact('days', 'domains', 'traps'));
    }

    public function foundationCreate()
    {
        return view('admin.foundation.create');
    }

    public function foundationStore(Request $request)
    {
        $request->validate([
            'day_number' => 'required|integer|between:1,60|unique:foundation_days,day_number',
            'phase' => 'required|integer|between:1,3',
            'title' => 'required|string',
            'domain' => 'required|string',
            'mission' => 'required|string',
            'learning_objective' => 'required|string',
            'difficulty' => 'required|string',
            'primary_skill' => 'required|string',
            'primary_trap' => 'required|string',
            'scenario_text' => 'required|string',
            'raw_json' => 'nullable|string',
        ]);

        $dayData = [];

        if ($request->filled('raw_json')) {
            $parsed = json_decode($request->raw_json, true);
            if (!$parsed || !is_array($parsed)) {
                return back()->withInput()->withErrors(['raw_json' => 'Invalid JSON string provided.']);
            }
            $dayData = $parsed;
            $dayData['day'] = (int) $request->day_number;
        } else {
            $dayData = [
                'day' => (int) $request->day_number,
                'phase' => (int) $request->phase,
                'title' => $request->title,
                'domain' => $request->domain,
                'mission' => $request->mission,
                'learning_objective' => $request->learning_objective,
                'difficulty' => $request->difficulty,
                'emotional_intensity' => $request->emotional_intensity ?? 'Low',
                'estimated_minutes' => $request->estimated_minutes ?? '3-5',
                'primary_skill' => $request->primary_skill,
                'primary_trap' => $request->primary_trap,
                'secondary_trap' => $request->secondary_trap ?? null,
                'scenario_text' => $request->scenario_text,
                'steps' => [
                    [
                        'step_number' => 1,
                        'key' => 'detect',
                        'insight' => $request->detect_insight ?? "Your brain creates stories automatically.\nSeparate them from facts.",
                        'inputs' => [
                            ['field_key' => 'facts', 'prompt' => 'Write only the facts.', 'multiline' => true],
                            ['field_key' => 'story', 'prompt' => 'Write story/assumptions.', 'multiline' => true]
                        ],
                        'reference_example' => $request->detect_example ?? ''
                    ],
                    [
                        'step_number' => 2,
                        'key' => 'decode',
                        'prompt' => 'Which thinking trap is most likely at work?',
                        'input_type' => 'single_choice',
                        'options' => [
                            ['key' => \Illuminate\Support\Str::slug($request->primary_trap, '_'), 'label' => $request->primary_trap, 'definition' => 'Main thinking trap']
                        ],
                        'correct_option_key' => \Illuminate\Support\Str::slug($request->primary_trap, '_'),
                        'explanation_reveal' => 'after_selection',
                        'explanation' => $request->decode_explanation ?? ''
                    ],
                    [
                        'step_number' => 3,
                        'key' => 'reality_check',
                        'tip' => 'Ask "What happened?" before asking "What does it mean?"',
                        'inputs' => [
                            ['field_key' => 'q1', 'prompt' => '1. What fact do you know for certain?'],
                            ['field_key' => 'q2', 'prompt' => '2. What are you assuming?'],
                            ['field_key' => 'q3', 'prompt' => '3. What evidence supports your assumption?'],
                            ['field_key' => 'q4', 'prompt' => '4. What evidence contradicts it?'],
                            ['field_key' => 'q5', 'prompt' => '5. What would you tell a friend?']
                        ]
                    ],
                    [
                        'step_number' => 4,
                        'key' => 'reframe',
                        'inputs' => [
                            ['field_key' => 'alt_explanations', 'prompt' => 'Write at least 3 other explanations.', 'type' => 'multi_entry', 'min_entries' => 3],
                            ['field_key' => 'one_more_explanation', 'prompt' => 'Can you think of one more explanation?']
                        ],
                        'reference_example' => array_filter(explode("\n", $request->reframe_examples ?? ''))
                    ],
                    [
                        'step_number' => 5,
                        'key' => 'intervention',
                        'reminder' => 'There is usually one reasonable action based on evidence.',
                        'inputs' => [
                            ['field_key' => 'action', 'prompt' => 'What is one thoughtful action you can take?']
                        ],
                        'reference_example' => $request->intervention_action ?? ''
                    ],
                    [
                        'step_number' => 6,
                        'key' => 'internalize',
                        'inputs' => [
                            ['field_key' => 'principle', 'prompt' => 'Complete this sentence: "Today I learned that..."']
                        ],
                        'reference_example' => $request->internalize_principle ?? ''
                    ]
                ],
                'closing_reflection' => [
                    'prompt' => $request->closing_prompt ?? 'Where else might I be confusing facts with stories?',
                    'journal_input' => ['field_key' => 'journal', 'prompt' => 'Optional journal entry.', 'required' => false]
                ]
            ];
        }

        FoundationDay::create([
            'day_number' => (int) $request->day_number,
            'phase' => (int) $request->phase,
            'title' => $request->title,
            'domain' => $request->domain,
            'primary_trap' => $request->primary_trap,
            'secondary_trap' => $request->secondary_trap ?? null,
            'content_bundle' => $dayData,
        ]);

        return redirect()->route('admin.foundation.index')->with('success', "Foundation Day {$request->day_number} created successfully!");
    }

    public function foundationEdit($id)
    {
        $day = FoundationDay::findOrFail($id);
        $rawJson = json_encode($day->content_bundle, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return view('admin.foundation.edit', compact('day', 'rawJson'));
    }

    public function foundationUpdate(Request $request, $id)
    {
        $day = FoundationDay::findOrFail($id);

        $request->validate([
            'day_number' => 'required|integer|between:1,60',
            'phase' => 'required|integer|between:1,3',
            'title' => 'required|string',
            'domain' => 'required|string',
            'primary_trap' => 'required|string',
            'raw_json' => 'nullable|string',
        ]);

        if ($request->filled('raw_json')) {
            $parsed = json_decode($request->raw_json, true);
            if (!$parsed || !is_array($parsed)) {
                return back()->withInput()->withErrors(['raw_json' => 'Invalid JSON string provided.']);
            }
            $dayBundle = $parsed;
        } else {
            $dayBundle = $day->content_bundle;
            $dayBundle['title'] = $request->title;
            $dayBundle['domain'] = $request->domain;
            $dayBundle['mission'] = $request->mission ?? ($dayBundle['mission'] ?? '');
            $dayBundle['learning_objective'] = $request->learning_objective ?? ($dayBundle['learning_objective'] ?? '');
            $dayBundle['scenario_text'] = $request->scenario_text ?? ($dayBundle['scenario_text'] ?? '');
            $dayBundle['primary_trap'] = $request->primary_trap;
        }

        $day->update([
            'day_number' => (int) $request->day_number,
            'phase' => (int) $request->phase,
            'title' => $request->title,
            'domain' => $request->domain,
            'primary_trap' => $request->primary_trap,
            'secondary_trap' => $request->secondary_trap ?? null,
            'content_bundle' => $dayBundle,
        ]);

        return redirect()->route('admin.foundation.index')->with('success', "Foundation Day {$request->day_number} updated successfully!");
    }

    public function foundationPreview($id)
    {
        $day = FoundationDay::findOrFail($id);
        $bundle = $day->content_bundle;
        return view('admin.foundation.preview', compact('day', 'bundle'));
    }

    public function foundationDestroy($id)
    {
        $day = FoundationDay::findOrFail($id);
        $dayNumber = $day->day_number;
        $day->delete();

        return redirect()->route('admin.foundation.index')->with('success', "Foundation Day {$dayNumber} deleted.");
    }

    public function foundationReSeed()
    {
        $seeder = new FoundationPhase1Seeder();
        $seeder->run();

        return redirect()->route('admin.foundation.index')->with('success', 'All 20 Phase 1 Foundation Program Days successfully re-seeded from JSON dataset!');
    }

    /*
    |--------------------------------------------------------------------------
    | Legacy Case Studies & Other Admin Methods
    |--------------------------------------------------------------------------
    */

    public function casesIndex(Request $request)
    {
        $query = CaseStudy::orderBy('day_number', 'asc');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('case_id', 'LIKE', "%{$search}%")
                  ->orWhere('day_number', 'LIKE', "%{$search}%")
                  ->orWhere('domain', 'LIKE', "%{$search}%")
                  ->orWhere('primary_trap', 'LIKE', "%{$search}%")
                  ->orWhere('primary_skill', 'LIKE', "%{$search}%")
                  ->orWhere('mission', 'LIKE', "%{$search}%")
                  ->orWhere('learning_objective', 'LIKE', "%{$search}%")
                  ->orWhere('opening_scenario', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        if ($request->filled('trap')) {
            $query->where('primary_trap', $request->trap);
        }

        $cases = $query->paginate(15)->withQueryString();

        $domains = CaseStudy::distinct()->pluck('domain')->filter();
        $traps = CaseStudy::distinct()->pluck('primary_trap')->filter();

        return view('admin.cases.index', compact('cases', 'domains', 'traps'));
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

    public function usersIndex(Request $request)
    {
        $query = User::where(function($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })->latest();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('provider')) {
            if ($request->provider === 'email') {
                $query->where(function($q) {
                    $q->whereNull('provider')->orWhere('provider', 'email');
                });
            } else {
                $query->where('provider', $request->provider);
            }
        }

        if ($request->filled('phase') && $request->phase !== '') {
            $query->where('phase', (int)$request->phase);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }
}
