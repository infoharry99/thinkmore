@extends('admin.layouts.app')

@section('title', 'Foundation Program Phase 1 (Days 1–20)')

@section('content')
<div class="card-box" style="padding: 28px;">
    <!-- Top Action Header -->
    <div class="card-header-flex" style="margin-bottom: 20px;">
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: #111827; margin: 0;">Foundation Program Phase 1 Curriculum (Days 1–20)</h3>
            <p style="font-size: 13px; color: #6B7280; margin-top: 4px;">Manage the 20 judgment scenarios, 6-step framework copy, decode options, tips, and JSON bundles served by the REST API.</p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <form action="{{ route('admin.foundation.seed') }}" method="POST" onsubmit="return confirm('Re-seed all 20 Phase 1 days from original JSON dataset?');" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline-success" style="border-radius: 10px; font-size: 13px; font-weight: 700; padding: 9px 16px;">
                    <i class="bi bi-arrow-repeat"></i> Re-seed Days 1–20 Data
                </button>
            </form>

            <a href="{{ route('admin.foundation.create') }}" class="btn-primary" style="padding: 10px 20px; font-weight: 700; border-radius: 10px;">
                <i class="bi bi-plus-circle"></i> Add New Foundation Day
            </a>
        </div>
    </div>

    <!-- Search & Filter Controls Bar -->
    <form action="{{ route('admin.foundation.index') }}" method="GET" style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 18px; border-radius: 14px; margin-bottom: 24px;">
        <div style="display: grid; grid-template-columns: 2.5fr 1fr 1fr 0.8fr 0.8fr; gap: 12px; align-items: center;">
            
            <!-- Search Text Input -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Search Curriculum Days</label>
                <div style="position: relative;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Day #, Title, Domain, Trap, Skill..." class="form-control" style="padding-left: 36px; border-radius: 10px; font-size: 13px;">
                    <i class="bi bi-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <!-- Domain Filter Dropdown -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Domain Category</label>
                <select name="domain" class="form-select" style="border-radius: 10px; font-size: 13px;">
                    <option value="">All Domains</option>
                    @foreach($domains as $d)
                        <option value="{{ $d }}" {{ request('domain') === $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Thinking Trap Filter Dropdown -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Primary Trap</label>
                <select name="trap" class="form-select" style="border-radius: 10px; font-size: 13px;">
                    <option value="">All Traps</option>
                    @foreach($traps as $t)
                        <option value="{{ $t }}" {{ request('trap') === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div style="margin-top: 18px;">
                <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; font-size: 13px; font-weight: 700; border-radius: 10px; justify-content: center;">
                    <i class="bi bi-funnel-fill"></i> Filter
                </button>
            </div>

            <!-- Reset Button -->
            <div style="margin-top: 18px;">
                <a href="{{ route('admin.foundation.index') }}" style="display: flex; justify-content: center; align-items: center; width: 100%; text-align: center; padding: 10px; border-radius: 10px; border: 1px solid #CBD5E1; color: #475569; font-size: 13px; font-weight: 700; text-decoration: none; background: white;">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Results Status Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; padding: 0 4px;">
        <div style="font-size: 13px; color: #475569; font-weight: 600;">
            Showing {{ $days->firstItem() ?? 0 }} to {{ $days->lastItem() ?? 0 }} of {{ $days->total() }} Foundation Days
            @if(request('search') || request('domain') || request('trap'))
                <span style="color: #0284C7; font-weight: 700;">(Filtered Results)</span>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Day #</th>
                    <th>Scenario Title</th>
                    <th>Domain</th>
                    <th>Primary Trap</th>
                    <th>Primary Skill</th>
                    <th>Learning Objective</th>
                    <th>Scenario Preview</th>
                    <th style="min-width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($days as $d)
                @php $bundle = $d->content_bundle; @endphp
                <tr>
                    <td>
                        <span class="badge badge-green" style="font-size: 13px; font-weight: 700;">Day {{ $d->day_number }}</span>
                    </td>
                    <td><strong>{{ $d->title }}</strong></td>
                    <td><span class="badge badge-gray">{{ $d->domain }}</span></td>
                    <td>
                        <span class="badge badge-green">{{ $d->primary_trap ?? '—' }}</span>
                    </td>
                    <td>
                        <span class="badge badge-gray">{{ $bundle['primary_skill'] ?? 'Detect' }}</span>
                    </td>
                    <td style="max-width: 220px; font-size: 13px;">
                        <strong>{{ $bundle['learning_objective'] ?? '' }}</strong><br>
                        <span style="color: #6B7280; font-size: 12px;">{{ $bundle['mission'] ?? '' }}</span>
                    </td>
                    <td style="max-width: 260px; font-size: 13px;">{{ Str::limit($bundle['scenario_text'] ?? '', 75) }}</td>
                    <td>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <a href="{{ route('admin.foundation.preview', $d->id) }}" style="background: #E0F2FE; color: #0284C7; font-weight: 700; padding: 6px 10px; border-radius: 8px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="bi bi-eye-fill"></i> Preview
                            </a>
                            <a href="{{ route('admin.foundation.edit', $d->id) }}" style="color: #1E6146; font-weight: 700; text-decoration: none; font-size: 13px; padding: 6px 10px; background: #E8F3EE; border-radius: 8px;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.foundation.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Delete Day {{ $d->day_number }}?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #EF4444; font-size: 13px; font-weight: 600; cursor: pointer; padding: 6px 8px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #9CA3AF; padding: 32px;">
                        <i class="bi bi-calendar-x" style="font-size: 28px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
                        No matching Foundation Program days found. Click <strong>"Re-seed Days 1–20 Data"</strong> above to populate!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Clean Bootstrap 5 Pagination Links -->
    <div style="padding: 20px 4px 0 4px; display: flex; justify-content: flex-end;">
        {{ $days->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
