@extends('admin.layouts.app')

@section('title', 'Phase 1 Curriculum Case Studies (Days 1–20)')

@section('content')
<div class="card-box">
    <div class="card-header-flex">
        <div>
            <h3 style="font-size: 18px; font-weight: 800;">ThinkClear Curriculum Cases (Days 1–60)</h3>
            <p style="font-size: 13px; color: #6B7280; margin-top: 2px;">Managing daily scenarios, 6-step framework copy, traps & model insights.</p>
        </div>
        <a href="{{ route('admin.cases.create') }}" class="btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Day Case
        </a>
    </div>

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
                    <th>Actions</th>
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
                        <a href="{{ route('admin.cases.edit', $c->id) }}" style="color: #1E6146; font-weight: 700; text-decoration: none;">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; color: #9CA3AF; padding: 24px;">No cases found in the library.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 16px 24px;">
        {{ $cases->links() }}
    </div>
</div>
@endsection
