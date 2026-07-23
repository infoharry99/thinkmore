@extends('admin.layouts.app')

@section('title', 'Student Progress Tracker')

@section('content')
<div class="card-box">
    <div class="card-header-flex">
        <h3 style="font-size: 16px; font-weight: 700;">Registered Students</h3>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Day</th>
                    <th>Current Phase</th>
                    <th>Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>#{{ $u->id }}</td>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge badge-green">Day {{ $u->current_day }} / 60</span>
                    </td>
                    <td>
                        @if($u->phase == 0)
                            <span class="badge badge-gray">Phase 0: Onboarding</span>
                        @elseif($u->phase == 1)
                            <span class="badge badge-green">Phase 1: Guided</span>
                        @elseif($u->phase == 2)
                            <span class="badge badge-gray">Phase 2: Semi-Guided</span>
                        @else
                            <span class="badge badge-green">Phase 3: Independent</span>
                        @endif
                    </td>
                    <td style="color: #9CA3AF;">{{ $u->created_at ? $u->created_at->format('M d, Y') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #9CA3AF; padding: 24px;">No registered students found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 16px 24px;">
        {{ $users->links() }}
    </div>
</div>
@endsection
