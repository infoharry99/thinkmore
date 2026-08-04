@extends('admin.layouts.app')

@section('title', 'Edit Case Study')

@section('content')
<div class="card-box" style="max-width: 950px; padding: 36px; margin: 0 auto;">
    <div style="margin-bottom: 24px; border-bottom: 2px solid #F3F4F6; padding-bottom: 16px;">
        <h3 style="font-size: 22px; font-weight: 800; color: #111827;">Edit Day {{ $case->day_number }} Case Study: {{ $case->case_id }}</h3>
        <p style="font-size: 14px; color: #6B7280; margin-top: 4px;">Update scenario narrative, step prompts, trap explanations, and model principles.</p>
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

    <form action="{{ route('admin.cases.update', $case->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1.2fr 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Day Number</label>
                <input type="number" name="day_number" required min="1" max="60" value="{{ old('day_number', $case->day_number) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Domain Category</label>
                <input type="text" name="domain" required value="{{ old('domain', $case->domain) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Primary Trap</label>
                <input type="text" name="primary_trap" required value="{{ old('primary_trap', $case->primary_trap) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Target Phase</label>
                <select name="phase_target" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
                    <option value="1" {{ $case->phase_target == 1 ? 'selected' : '' }}>Phase 1 (Guided)</option>
                    <option value="2" {{ $case->phase_target == 2 ? 'selected' : '' }}>Phase 2 (Semi-Guided)</option>
                    <option value="3" {{ $case->phase_target == 3 ? 'selected' : '' }}>Phase 3 (Independent)</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Primary Skill</label>
                <input type="text" name="primary_skill" required value="{{ old('primary_skill', $case->primary_skill) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Difficulty Level</label>
                <input type="text" name="difficulty" required value="{{ old('difficulty', $case->difficulty) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Status</label>
                <select name="is_active" required style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; background: white;">
                    <option value="1" {{ $case->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$case->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 24px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Mission Tagline</label>
                <input type="text" name="mission" required value="{{ old('mission', $case->mission) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Learning Objective</label>
                <input type="text" name="learning_objective" required value="{{ old('learning_objective', $case->learning_objective) }}" style="width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px;">
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display:block; font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 6px;">Opening Scenario (Ambiguous Situation)</label>
            <textarea name="opening_scenario" rows="5" required style="width: 100%; padding: 14px; border-radius: 10px; border: 1.5px solid #D1D5DB; font-size: 14px; line-height: 1.5; font-family: inherit;">{{ old('opening_scenario', $case->opening_scenario) }}</textarea>
        </div>

        <div style="display: flex; gap: 14px;">
            <button type="submit" class="btn-primary" style="padding: 12px 28px; font-size: 15px; font-weight: 700; border-radius: 10px;">
                <i class="bi bi-check-circle"></i> Update Case Study
            </button>
            <a href="{{ route('admin.cases.index') }}" style="padding: 12px 24px; border-radius: 10px; border: 1.5px solid #D1D5DB; color: #374151; text-decoration: none; font-weight: 600; font-size: 15px; display: inline-flex; align-items: center;">Cancel</a>
        </div>
    </form>
</div>
@endsection
