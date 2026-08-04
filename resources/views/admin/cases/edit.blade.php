@extends('admin.layouts.app')

@section('title', 'Edit Case Study')

@section('content')
<div class="card-box" style="max-width: 900px; padding: 32px;">
    <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 24px;">Edit Day {{ $case->day_number }} Case Study: {{ $case->case_id }}</h3>

    <form action="{{ route('admin.cases.update', $case->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Day Number</label>
                <input type="number" name="day_number" required min="1" max="60" value="{{ old('day_number', $case->day_number) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Domain Category</label>
                <input type="text" name="domain" required value="{{ old('domain', $case->domain) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Primary Trap</label>
                <input type="text" name="primary_trap" required value="{{ old('primary_trap', $case->primary_trap) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Target Phase</label>
                <select name="phase_target" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="1" {{ $case->phase_target == 1 ? 'selected' : '' }}>Phase 1 (Guided)</option>
                    <option value="2" {{ $case->phase_target == 2 ? 'selected' : '' }}>Phase 2 (Semi-Guided)</option>
                    <option value="3" {{ $case->phase_target == 3 ? 'selected' : '' }}>Phase 3 (Independent)</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Primary Skill</label>
                <input type="text" name="primary_skill" required value="{{ old('primary_skill', $case->primary_skill) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Difficulty</label>
                <input type="text" name="difficulty" required value="{{ old('difficulty', $case->difficulty) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Status</label>
                <select name="is_active" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
                    <option value="1" {{ $case->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$case->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Mission Tagline</label>
                <input type="text" name="mission" required value="{{ old('mission', $case->mission) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
            <div>
                <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Learning Objective</label>
                <input type="text" name="learning_objective" required value="{{ old('learning_objective', $case->learning_objective) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #D1D5DB;">
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display:block; font-size: 13px; font-weight: 600; margin-bottom: 6px;">Opening Scenario</label>
            <textarea name="opening_scenario" rows="4" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #D1D5DB;">{{ old('opening_scenario', $case->opening_scenario) }}</textarea>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-primary">Update Case Study</button>
            <a href="{{ route('admin.cases.index') }}" style="padding: 10px 18px; border-radius: 10px; border: 1px solid #D1D5DB; color: #374151; text-decoration: none; font-weight: 600;">Cancel</a>
        </div>
    </form>
</div>
@endsection
