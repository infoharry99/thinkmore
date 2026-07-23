@extends('admin.layouts.app')

@section('title', 'Case Library Management')

@section('content')
<div class="card-box">
    <div class="card-header-flex">
        <h3 style="font-size: 16px; font-weight: 700;">60-Day Case Library</h3>
        <a href="{{ route('admin.cases.create') }}" class="btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Case
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Case ID</th>
                    <th>Domain</th>
                    <th>Target Phase</th>
                    <th>Target Traps</th>
                    <th>Opening Scenario</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cases as $c)
                <tr>
                    <td><strong>{{ $c->case_id }}</strong></td>
                    <td><span class="badge badge-gray">{{ $c->domain }}</span></td>
                    <td>Phase {{ $c->phase_target }}</td>
                    <td>
                        @if(is_array($c->trap_target))
                            @foreach($c->trap_target as $trap)
                                <span class="badge badge-green" style="font-size: 11px;">{{ $trap }}</span>
                            @endforeach
                        @else
                            {{ $c->trap_target }}
                        @endif
                    </td>
                    <td style="max-width: 300px;">{{ Str::limit($c->opening_scenario, 80) }}</td>
                    <td>
                        @if($c->is_active)
                            <span class="badge badge-green">Active</span>
                        @else
                            <span class="badge badge-gray">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.cases.edit', $c->id) }}" style="color: #1E6146; font-weight: 600; text-decoration: none;">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #9CA3AF; padding: 24px;">No cases found in the library.</td>
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
