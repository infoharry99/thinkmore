@extends('admin.layouts.app')

@section('title', 'Phase 1 Curriculum Case Studies (Days 1–20)')

@section('content')
<div class="card-box" style="padding: 28px;">
    <!-- Top Action Header -->
    <div class="card-header-flex" style="margin-bottom: 20px;">
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: #111827;">ThinkClear Curriculum Library (Days 1–60)</h3>
            <p style="font-size: 13px; color: #6B7280; margin-top: 2px;">Search, filter, edit, and preview daily judgment scenarios and 6-step framework copy.</p>
        </div>
        <a href="{{ route('admin.cases.create') }}" class="btn-primary" style="padding: 10px 20px; font-weight: 700; border-radius: 10px;">
            <i class="bi bi-plus-circle"></i> Add New Day Case
        </a>
    </div>

    <!-- Search & Filter Controls Bar -->
    <form action="{{ route('admin.cases.index') }}" method="GET" style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 18px; border-radius: 14px; margin-bottom: 24px;">
        <div style="display: grid; grid-template-columns: 2.5fr 1fr 1fr 0.8fr 0.8fr; gap: 12px; align-items: center;">
            
            <!-- Search Text Input -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Search Scenarios</label>
                <div style="position: relative;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Day, ID, Trap, Skill, Domain, Scenario..." style="width: 100%; padding: 10px 12px 10px 36px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 13px;">
                    <i class="bi bi-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <!-- Domain Filter Dropdown -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Domain Category</label>
                <select name="domain" style="width: 100%; padding: 10px 12px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 13px; background: white;">
                    <option value="">All Domains</option>
                    @foreach($domains as $d)
                        <option value="{{ $d }}" {{ request('domain') === $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Thinking Trap Filter Dropdown -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Thinking Trap</label>
                <select name="trap" style="width: 100%; padding: 10px 12px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 13px; background: white;">
                    <option value="">All Traps</option>
                    @foreach($traps as $t)
                        <option value="{{ $t }}" {{ request('trap') === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div style="margin-top: 18px;">
                <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; font-size: 13px; font-weight: 700; border-radius: 10px; text-align: center;">
                    <i class="bi bi-funnel-fill"></i> Filter
                </button>
            </div>

            <!-- Reset Button -->
            <div style="margin-top: 18px;">
                <a href="{{ route('admin.cases.index') }}" style="display: block; width: 100%; text-align: center; padding: 10px; border-radius: 10px; border: 1px solid #CBD5E1; color: #475569; font-size: 13px; font-weight: 700; text-decoration: none; background: white;">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Results Status Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; padding: 0 4px;">
        <div style="font-size: 13px; color: #475569; font-weight: 600;">
            Showing {{ $cases->firstItem() ?? 0 }} to {{ $cases->lastItem() ?? 0 }} of {{ $cases->total() }} scenario cases
            @if(request('search') || request('domain') || request('trap'))
                <span style="color: #0284C7; font-weight: 700;">(Filtered Results)</span>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Day #</th>
                    <th>Case ID</th>
                    <th>Domain</th>
                    <th>Primary Trap</th>
                    <th>Primary Skill</th>
                    <th>Mission / Objective</th>
                    <th>Scenario Preview</th>
                    <th>Status</th>
                    <th style="min-width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cases as $c)
                <tr>
                    <td>
                        <span class="badge badge-green" style="font-size: 13px; font-weight: 700;">Day {{ $c->day_number }}</span>
                    </td>
                    <td><strong>{{ $c->case_id }}</strong></td>
                    <td><span class="badge badge-gray">{{ $c->domain }}</span></td>
                    <td>
                        <span class="badge badge-green">{{ $c->primary_trap ?? ($c->trap_target[0] ?? '—') }}</span>
                    </td>
                    <td>
                        <span class="badge badge-gray">{{ $c->primary_skill ?? 'Detect' }}</span>
                    </td>
                    <td style="max-width: 220px; font-size: 13px;">
                        <strong>{{ $c->learning_objective ?? '' }}</strong><br>
                        <span style="color: #6B7280; font-size: 12px;">{{ $c->mission ?? '' }}</span>
                    </td>
                    <td style="max-width: 260px; font-size: 13px;">{{ Str::limit($c->opening_scenario, 75) }}</td>
                    <td>
                        @if($c->is_active)
                            <span class="badge badge-green">Active</span>
                        @else
                            <span class="badge badge-gray">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <a href="{{ route('admin.cases.preview', $c->id) }}" style="background: #E0F2FE; color: #0284C7; font-weight: 700; padding: 6px 12px; border-radius: 8px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="bi bi-eye-fill"></i> Preview
                            </a>
                            <a href="{{ route('admin.cases.edit', $c->id) }}" style="color: #1E6146; font-weight: 700; text-decoration: none; font-size: 13px;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; color: #9CA3AF; padding: 32px;">
                        <i class="bi bi-search" style="font-size: 24px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
                        No matching scenario cases found for your query. Try resetting filters.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links maintaining query string -->
    <div style="padding: 20px 4px 0 4px; display: flex; justify-content: space-between; align-items: center;">
        {{ $cases->links() }}
    </div>
</div>
@endsection
