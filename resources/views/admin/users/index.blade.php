@extends('admin.layouts.app')

@section('title', 'Student Progress Tracker')

@section('content')
<div class="card-box" style="padding: 28px;">
    <div class="card-header-flex" style="margin-bottom: 20px;">
        <div>
            <h3 style="font-size: 18px; font-weight: 800;">Registered Students</h3>
            <p style="font-size: 13px; color: #6B7280; margin-top: 2px;">All registered mobile application users, progress days, and login providers.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Auth Provider</th>
                    <th>Current Day</th>
                    <th>Current Phase</th>
                    <th>Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td><strong>#{{ $u->id }}</strong></td>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td>{{ $u->email }}</td>
                    <td>
                        @if($u->provider === 'google')
                            <span class="badge badge-gray" style="background: #E0F2FE; color: #0369A1;"><i class="bi bi-google"></i> Google</span>
                        @elseif($u->provider === 'apple')
                            <span class="badge badge-gray" style="background: #F3F4F6; color: #111827;"><i class="bi bi-apple"></i> Apple</span>
                        @else
                            <span class="badge badge-gray" style="background: #ECFDF5; color: #047857;"><i class="bi bi-envelope"></i> Email</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-green" style="font-size: 13px; font-weight: 700;">Day {{ $u->current_day }} / 60</span>
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
                    <td style="color: #6B7280; font-size: 13px;">{{ $u->created_at ? $u->created_at->format('M d, Y • h:i A') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #9CA3AF; padding: 24px;">No registered students found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 4px 0 4px; display: flex; justify-content: flex-end;">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
