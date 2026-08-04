@extends('admin.layouts.app')

@section('title', 'Add New Curriculum Day Case')

@section('content')
<div class="card-box" style="max-width: 900px; padding: 32px;">
    <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 24px;">Create Curriculum Judgment Scenario</h3>

    @if($errors->any())
        <div style="background: #FEE2E2; color: #991B1B; padding: 14px; border-radius: 10px; margin-bottom: 24px;">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cases.store') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Day Number (1 to 60)</label>
                <input type="number" name="day_number" required min="1" max="60" value="{{ old('day_number', 21) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Case ID (e.g. P1-021)</label>
                <input type="text" name="case_id" required value="{{ old('case_id') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Domain Category</label>
                <select name="domain" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="Relationships">Relationships</option>
                    <option value="Workplace">Workplace</option>
                    <option value="Family">Family</option>
                    <option value="Health">Health</option>
                    <option value="Career">Career</option>
                    <option value="Parenting">Parenting</option>
                    <option value="Business">Business</option>
                    <option value="Finance">Finance</option>
                    <option value="Negotiation">Negotiation</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Target Phase</label>
                <select name="phase_target" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="1">Phase 1 (Guided)</option>
                    <option value="2">Phase 2 (Semi-Guided)</option>
                    <option value="3">Phase 3 (Independent)</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Primary Trap</label>
                <select name="primary_trap" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="Mind Reading">Mind Reading</option>
                    <option value="Fortune Telling">Fortune Telling</option>
                    <option value="Emotional Reasoning">Emotional Reasoning</option>
                    <option value="Catastrophizing">Catastrophizing</option>
                    <option value="Confirmation Bias">Confirmation Bias</option>
                    <option value="Rumination">Rumination</option>
                    <option value="Validation Seeking">Validation Seeking</option>
                    <option value="Sunk Cost Fallacy">Sunk Cost Fallacy</option>
                    <option value="All-or-Nothing Thinking">All-or-Nothing Thinking</option>
                    <option value="Mixed Judgment Scenario">Mixed Judgment Scenario</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Primary Skill Practiced</label>
                <select name="primary_skill" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="Detect">Detect</option>
                    <option value="Decode">Decode</option>
                    <option value="Reality Check">Reality Check</option>
                    <option value="Reframe">Reframe</option>
                    <option value="Intervention">Intervention</option>
                    <option value="Internalize">Internalize</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Difficulty</label>
                <select name="difficulty" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                    <option value="Checkpoint">Checkpoint</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Mission Tagline</label>
                <input type="text" name="mission" required value="{{ old('mission') }}" placeholder="Don't let your mind write the story..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Learning Objective</label>
                <input type="text" name="learning_objective" required value="{{ old('learning_objective') }}" placeholder="Separate Facts from Stories" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Judgment Scenario (Shown to User)</label>
            <textarea name="opening_scenario" rows="4" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #D1D5DB;">{{ old('opening_scenario') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 1: Model Fact Line</label>
                <input type="text" name="fact_line" required value="{{ old('fact_line') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 1: Model Story Line</label>
                <input type="text" name="story_line" required value="{{ old('story_line') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 2: Trap Explanation</label>
            <input type="text" name="trap_explanation" required value="{{ old('trap_explanation') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 5: Single Thoughtful Action</label>
            <input type="text" name="action_text" required value="{{ old('action_text') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 6: Universal Principle (1 Line)</label>
                <input type="text" name="internalize_principle" required value="{{ old('internalize_principle') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Closing Reflection Question</label>
                <input type="text" name="closing_reflection" value="{{ old('closing_reflection') }}" placeholder="Where else in my life might I..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-primary">Save Curriculum Case</button>
            <a href="{{ route('admin.cases.index') }}" style="padding: 10px 18px; border-radius: 10px; border: 1px solid #D1D5DB; color: #374151; text-decoration: none; font-weight: 600;">Cancel</a>
        </div>
    </form>
</div>
@endsection
