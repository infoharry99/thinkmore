@extends('admin.layouts.app')

@section('title', 'Edit Foundation Day ' . $day->day_number)

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <a href="{{ route('admin.foundation.index') }}" style="color: #6B7280; text-decoration: none; font-size: 14px; font-weight: 600;">
            ← Back to Foundation Program List
        </a>
        <h3 style="font-size: 22px; font-weight: 800; color: #111827; margin-top: 4px;">
            Edit Foundation Program Day {{ $day->day_number }} ("{{ $day->title }}")
        </h3>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.foundation.preview', $day->id) }}" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 700; font-size: 13px;">
            <i class="bi bi-eye-fill"></i> Mobile Preview
        </a>
    </div>
</div>

<form action="{{ route('admin.foundation.update', $day->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        
        <!-- Form Details Column -->
        <div class="card-box" style="padding: 24px;">
            <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 16px; color: #1E6146;">1. Day Attributes & Copy</h4>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label font-semibold">Day Number *</label>
                    <input type="number" name="day_number" value="{{ old('day_number', $day->day_number) }}" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label font-semibold">Phase *</label>
                    <select name="phase" class="form-select" required>
                        <option value="1" {{ $day->phase == 1 ? 'selected' : '' }}>Phase 1: Guided</option>
                        <option value="2" {{ $day->phase == 2 ? 'selected' : '' }}>Phase 2: Semi-Guided</option>
                        <option value="3" {{ $day->phase == 3 ? 'selected' : '' }}>Phase 3: Independent</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label font-semibold">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $day->title) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label font-semibold">Domain *</label>
                    <input type="text" name="domain" value="{{ old('domain', $day->domain) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label font-semibold">Primary Trap *</label>
                    <input type="text" name="primary_trap" value="{{ old('primary_trap', $day->primary_trap) }}" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label font-semibold">Day Mission</label>
                    <input type="text" name="mission" value="{{ old('mission', $day->content_bundle['mission'] ?? '') }}" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label font-semibold">Learning Objective</label>
                    <input type="text" name="learning_objective" value="{{ old('learning_objective', $day->content_bundle['learning_objective'] ?? '') }}" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label font-semibold">Opening Scenario Narrative Text</label>
                    <textarea name="scenario_text" rows="4" class="form-control">{{ old('scenario_text', $day->content_bundle['scenario_text'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Raw JSON Editor Column -->
        <div class="card-box" style="padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-align: center; margin-bottom: 8px;">
                <h4 style="font-size: 16px; font-weight: 700; color: #0284C7;">
                    <i class="bi bi-filetype-json"></i> Raw JSON Bundle Editor
                </h4>
                <span class="badge badge-gray" style="font-size: 11px;">Served directly by GET API</span>
            </div>
            <p style="font-size: 12px; color: #6B7280; margin-bottom: 12px;">
                You can directly edit the complete JSON bundle served by `GET /api/v1/foundation/phase1/days/{{ $day->day_number }}` below:
            </p>

            <textarea name="raw_json" rows="22" class="form-control font-monospace" style="font-size: 12px;">{{ $rawJson }}</textarea>

            <div style="margin-top: 20px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary" style="flex: 1; padding: 12px; font-size: 14px; font-weight: 700; justify-content: center; border-radius: 10px;">
                    <i class="bi bi-check-circle-fill"></i> Save Changes
                </button>
            </div>
        </div>

    </div>
</form>
@endsection
