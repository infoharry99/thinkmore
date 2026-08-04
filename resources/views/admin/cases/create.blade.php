@extends('admin.layouts.app')

@section('title', 'Add New Curriculum Day Case')

@section('content')
<div class="card-box" style="max-width: 950px; padding: 36px; margin: 0 auto;">
    <div style="margin-bottom: 24px; border-bottom: 2px solid #F3F4F6; padding-bottom: 16px;">
        <h3 style="font-size: 22px; font-weight: 800; color: #111827;">Create Curriculum Case Study</h3>
        <p style="font-size: 14px; color: #6B7280; margin-top: 4px;">Enter detailed scenario text, 6-step framework responses, trap explanations, and model principles.</p>
    </div>

    @if($errors->any())
        <div style="background: #FEE2E2; color: #991B1B; padding: 14px 18px; border-radius: 10px; margin-bottom: 24px; font-size: 14px;">
            <ul style="margin-left: 20px; margin-bottom: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cases.store') }}" method="POST">
        @csrf
        
        <!-- Metadata Header -->
        <div style="display: grid; grid-template-columns: 1fr 1.2fr 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Day Number (1 to 60)</label>
                <input type="number" name="day_number" required min="1" max="60" value="{{ old('day_number', 21) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Case ID (e.g. P1-021)</label>
                <input type="text" name="case_id" required value="{{ old('case_id') }}" placeholder="P1-021" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Domain Category</label>
                <select name="domain" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
                    <option value="Relationships">Relationships</option>
                    <option value="Relationships/Family">Relationships/Family</option>
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
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Target Phase</label>
                <select name="phase_target" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
                    <option value="1">Phase 1 (Guided)</option>
                    <option value="2">Phase 2 (Semi-Guided)</option>
                    <option value="3">Phase 3 (Independent)</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Thinking Trap Name</label>
                <select name="primary_trap" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
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
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Primary Skill Practiced</label>
                <select name="primary_skill" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
                    <option value="Detect">Detect</option>
                    <option value="Decode">Decode</option>
                    <option value="Reality Check">Reality Check</option>
                    <option value="Reframe">Reframe</option>
                    <option value="Intervention">Intervention</option>
                    <option value="Internalize">Internalize</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Difficulty Level</label>
                <select name="difficulty" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                    <option value="Checkpoint">Checkpoint</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Mission Tagline</label>
                <input type="text" name="mission" required value="{{ old('mission') }}" placeholder="Don't let your mind write the story before the facts." style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Learning Objective</label>
                <input type="text" name="learning_objective" required value="{{ old('learning_objective') }}" placeholder="Separate Facts from Stories" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
        </div>

        <!-- Scenario Textarea -->
        <div style="margin-bottom: 24px;">
            <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Opening Scenario (Ambiguous Situation)</label>
            <textarea name="opening_scenario" rows="5" required placeholder="Type full real-life scenario narrative here..." style="width: 100%; padding: 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('opening_scenario') }}</textarea>
        </div>

        <!-- Step 1 Textareas -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Step 1: Objective Fact Line</label>
                <textarea name="fact_line" rows="3" required placeholder="Fact: He read my message three hours ago and hasn't replied." style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('fact_line') }}</textarea>
            </div>
            <div>
                <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Step 1: Personal Story Line</label>
                <textarea name="story_line" rows="3" required placeholder="Story: He is upset with me and is ignoring me." style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('story_line') }}</textarea>
            </div>
        </div>

        <!-- Step 2 Trap Explanation Textarea -->
        <div style="margin-bottom: 24px;">
            <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Step 2: Trap Explanation</label>
            <textarea name="trap_explanation" rows="3" required placeholder="The only confirmed fact is that there has been no reply. The story is that he is upset..." style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('trap_explanation') }}</textarea>
        </div>

        <!-- Step 5 Single Recommended Action Textarea -->
        <div style="margin-bottom: 24px;">
            <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Step 5: Single Recommended Action</label>
            <textarea name="action_text" rows="3" required placeholder="Wait until the end of the workday. If there is still no reply, send one calm message..." style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('action_text') }}</textarea>
        </div>

        <!-- Step 6 Principles & Reflection Textareas -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 32px;">
            <div>
                <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Step 6: Universal Principle (1 Line)</label>
                <textarea name="internalize_principle" rows="3" required placeholder="A delayed reply is a fact. Being ignored is a story/assumptions until evidence proves otherwise." style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('internalize_principle') }}</textarea>
            </div>
            <div>
                <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Closing Reflection Question</label>
                <textarea name="closing_reflection" rows="3" placeholder="Where else in my life might I be confusing facts with stories?" style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('closing_reflection') }}</textarea>
            </div>
        </div>

        <div style="display: flex; gap: 14px;">
            <button type="submit" class="btn-primary" style="padding: 12px 28px; font-size: 15px; font-weight: 700; border-radius: 10px;">
                <i class="bi bi-check-circle"></i> Save Case Study
            </button>
            <a href="{{ route('admin.cases.index') }}" style="padding: 12px 24px; border-radius: 10px; border: 1.5px solid #D1D5DB; color: #374151; text-decoration: none; font-weight: 600; font-size: 15px; display: inline-flex; align-items: center;">Cancel</a>
        </div>
    </form>
</div>
@endsection
