@extends('admin.layouts.app')

@section('title', 'Add New Foundation Program Day')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.foundation.index') }}" style="color: #6B7280; text-decoration: none; font-size: 14px; font-weight: 600;">
        ← Back to Foundation Program List
    </a>
    <h3 style="font-size: 22px; font-weight: 800; color: #111827; margin-top: 4px;">
        Insert New Foundation Program Day Content
    </h3>
    <p style="font-size: 13px; color: #6B7280;">Fill in the form fields below OR paste a complete raw JSON bundle matching the Section 3 API specification.</p>
</div>

<form action="{{ route('admin.foundation.store') }}" method="POST">
    @csrf

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        
        <!-- Left Column: Form Fields -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            
            <!-- Metadata Card -->
            <div class="card-box" style="padding: 24px;">
                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 16px; color: #1E6146;">1. Day Metadata & Scenario</h4>
                
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label font-semibold">Day Number *</label>
                        <input type="number" name="day_number" value="{{ old('day_number', 21) }}" min="1" max="60" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label font-semibold">Phase *</label>
                        <select name="phase" class="form-select" required>
                            <option value="1">Phase 1: Guided</option>
                            <option value="2">Phase 2: Semi-Guided</option>
                            <option value="3">Phase 3: Independent</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-semibold">Scenario Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. The Unexpected Team Sync" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label font-semibold">Domain *</label>
                        <input type="text" name="domain" value="{{ old('domain', 'Workplace') }}" placeholder="e.g. Workplace, Relationships, Family, Health, Career" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label font-semibold">Primary Skill *</label>
                        <select name="primary_skill" class="form-select" required>
                            <option value="Detect">Detect</option>
                            <option value="Decode">Decode</option>
                            <option value="Reality Check">Reality Check</option>
                            <option value="Reframe">Reframe</option>
                            <option value="Intervention">Intervention</option>
                            <option value="Internalize">Internalize</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label font-semibold">Primary Trap *</label>
                        <input type="text" name="primary_trap" value="{{ old('primary_trap', 'Mind Reading') }}" placeholder="e.g. Mind Reading, Fortune Telling, Catastrophizing" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label font-semibold">Difficulty Level</label>
                        <select name="difficulty" class="form-select">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label font-semibold">Emotional Intensity</label>
                        <select name="emotional_intensity" class="form-select">
                            <option value="Low">Low</option>
                            <option value="Moderate">Moderate</option>
                            <option value="High">High</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label font-semibold">Est. Minutes</label>
                        <input type="text" name="estimated_minutes" value="3-5" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label font-semibold">Day Mission Tagline *</label>
                        <input type="text" name="mission" value="{{ old('mission') }}" placeholder="e.g. Don't let your mind write the story before the facts." class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label font-semibold">Learning Objective *</label>
                        <input type="text" name="learning_objective" value="{{ old('learning_objective') }}" placeholder="e.g. Separate Facts from Stories" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label font-semibold">Scenario Narrative Text *</label>
                        <textarea name="scenario_text" rows="4" class="form-control" placeholder="Write the real-life scenario shown to the user..." required>{{ old('scenario_text') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Steps & Model Insights Card -->
            <div class="card-box" style="padding: 24px;">
                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 16px; color: #1E6146;">2. Step Framework Copy & Reference Examples</h4>
                
                <div class="mb-3">
                    <label class="form-label font-semibold">Step 1 — Detect Insight Text</label>
                    <textarea name="detect_insight" rows="2" class="form-control" placeholder="Your brain creates stories automatically...">Your brain creates stories automatically. Your first responsibility is to separate them from facts.</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-semibold">Step 1 — Detect Reference Example (Fact & Story)</label>
                    <textarea name="detect_example" rows="2" class="form-control" placeholder="Fact: ... Story: ..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-semibold">Step 2 — Decode Explanation Text</label>
                    <textarea name="trap_explanation" rows="3" class="form-control" placeholder="Why this trap applies..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-semibold">Step 4 — Reframe Model Alternatives (One per line)</label>
                    <textarea name="reframe_examples" rows="3" class="form-control" placeholder="Alternative explanation 1...&#10;Alternative explanation 2...&#10;Alternative explanation 3..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-semibold">Step 5 — Intervention Action Reference Example</label>
                    <textarea name="intervention_action" rows="2" class="form-control" placeholder="Based on available evidence, what is one thoughtful action..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-semibold">Step 6 — Internalize Universal Principle</label>
                    <textarea name="internalize_principle" rows="2" class="form-control" placeholder="1-line principle learned..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-semibold">Closing Reflection Prompt</label>
                    <textarea name="closing_prompt" rows="2" class="form-control" placeholder="Where else in my life might I be confusing facts with stories?">Where else in my life might I be confusing facts with stories?</textarea>
                </div>
            </div>

        </div>

        <!-- Right Column: Raw JSON Input Option -->
        <div>
            <div class="card-box" style="padding: 24px; position: sticky; top: 20px;">
                <h4 style="font-size: 16px; font-weight: 700; color: #0284C7; margin-bottom: 8px;">
                    <i class="bi bi-filetype-json"></i> Raw JSON Bundle Import
                </h4>
                <p style="font-size: 12px; color: #6B7280; margin-bottom: 12px;">
                    Optionally paste a complete day JSON object here. If provided, it overrides form fields above to create the exact API payload!
                </p>

                <textarea name="raw_json" rows="18" class="form-control font-monospace" style="font-size: 12px;" placeholder='{
  "day": 21,
  "phase": 1,
  "title": "Sample Scenario",
  "steps": [ ... ]
}'></textarea>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 14px; font-weight: 700; justify-content: center; border-radius: 10px;">
                        <i class="bi bi-save"></i> Save Foundation Day
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
