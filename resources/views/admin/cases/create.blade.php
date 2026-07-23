@extends('admin.layouts.app')

@section('title', 'Add New Case Study')

@section('content')
<div class="card-box" style="max-width: 800px; padding: 32px;">
    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 24px;">Create Case Study</h3>

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
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Case ID (e.g. P1-002)</label>
                <input type="text" name="case_id" required value="{{ old('case_id') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Domain Category</label>
                <select name="domain" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="Relationships/Family">Relationships/Family</option>
                    <option value="Career">Career</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Leadership">Leadership</option>
                    <option value="Parenting">Parenting</option>
                    <option value="CEOs & Investors">CEOs & Investors</option>
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

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Opening Scenario (Ambiguous Situation)</label>
            <textarea name="opening_scenario" rows="3" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #D1D5DB;">{{ old('opening_scenario') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 1: Objective Fact Line</label>
                <input type="text" name="fact_line" required value="{{ old('fact_line') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 1: Personal Story Line</label>
                <input type="text" name="story_line" required value="{{ old('story_line') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 2: Thinking Trap Name</label>
                <select name="trap_name" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="Catastrophizing">Catastrophizing</option>
                    <option value="Mind Reading">Mind Reading</option>
                    <option value="Fortune Telling">Fortune Telling</option>
                    <option value="Emotional Reasoning">Emotional Reasoning</option>
                    <option value="Confirmation Bias">Confirmation Bias</option>
                    <option value="All-or-Nothing Thinking">All-or-Nothing Thinking</option>
                    <option value="Rumination">Rumination</option>
                    <option value="Validation Seeking">Validation Seeking</option>
                    <option value="Sunk Cost Fallacy">Sunk Cost Fallacy</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 2: Trap Explanation</label>
                <input type="text" name="trap_explanation" required value="{{ old('trap_explanation') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 5: Single Recommended Action</label>
            <input type="text" name="action_text" required value="{{ old('action_text') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
        </div>

        <div style="margin-bottom: 28px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Step 6: Universal Principle (1 Line)</label>
            <input type="text" name="internalize_principle" required value="{{ old('internalize_principle') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-primary">Save Case Study</button>
            <a href="{{ route('admin.cases.index') }}" style="padding: 10px 18px; border-radius: 10px; border: 1px solid #D1D5DB; color: #374151; text-decoration: none; font-weight: 600;">Cancel</a>
        </div>
    </form>
</div>
@endsection
