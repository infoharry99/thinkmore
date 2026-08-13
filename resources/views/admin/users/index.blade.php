@extends('admin.layouts.app')

@section('title', 'Student Progress Tracker')

@section('content')
<div class="card-box" style="padding: 28px;">
    <!-- Top Action Header -->
    <div class="card-header-flex" style="margin-bottom: 20px;">
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: #111827; margin: 0;">Registered Student Progress Tracker</h3>
            <p style="font-size: 13px; color: #6B7280; margin-top: 4px;">Monitor all registered ThinkClear mobile application students, curriculum day completion (1–60), active phases, and auth providers.</p>
        </div>
    </div>

    <!-- Search & Filter Controls Bar -->
    <form action="{{ route('admin.users.index') }}" method="GET" style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 18px; border-radius: 14px; margin-bottom: 24px;">
        <div style="display: grid; grid-template-columns: 2.5fr 1fr 1fr 0.8fr 0.8fr; gap: 12px; align-items: center;">
            
            <!-- Search Input -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Search Students</label>
                <div style="position: relative;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search student name, email, or user ID..." class="form-control" style="padding-left: 36px; border-radius: 10px; font-size: 13px;">
                    <i class="bi bi-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <!-- Provider Filter -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Auth Provider</label>
                <select name="provider" class="form-select" style="border-radius: 10px; font-size: 13px;">
                    <option value="">All Providers</option>
                    <option value="email" {{ request('provider') === 'email' ? 'selected' : '' }}>Email & Password</option>
                    <option value="google" {{ request('provider') === 'google' ? 'selected' : '' }}>Google OAuth</option>
                    <option value="apple" {{ request('provider') === 'apple' ? 'selected' : '' }}>Apple OAuth</option>
                </select>
            </div>

            <!-- Phase Filter -->
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px; text-transform: uppercase;">Curriculum Phase</label>
                <select name="phase" class="form-select" style="border-radius: 10px; font-size: 13px;">
                    <option value="">All Phases</option>
                    <option value="0" {{ request('phase') === '0' ? 'selected' : '' }}>Phase 0: Onboarding</option>
                    <option value="1" {{ request('phase') === '1' ? 'selected' : '' }}>Phase 1: Guided</option>
                    <option value="2" {{ request('phase') === '2' ? 'selected' : '' }}>Phase 2: Semi-Guided</option>
                    <option value="3" {{ request('phase') === '3' ? 'selected' : '' }}>Phase 3: Independent</option>
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
                <a href="{{ route('admin.users.index') }}" style="display: flex; justify-content: center; align-items: center; width: 100%; text-align: center; padding: 10px; border-radius: 10px; border: 1px solid #CBD5E1; color: #475569; font-size: 13px; font-weight: 700; text-decoration: none; background: white;">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Results Count Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; padding: 0 4px;">
        <div style="font-size: 13px; color: #475569; font-weight: 600;">
            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} Students
            @if(request('search') || request('provider') || request('phase') !== null)
                <span style="color: #0284C7; font-weight: 700;">(Filtered Results)</span>
            @endif
        </div>
    </div>

    <!-- Bootstrap 5 Table Layout -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
            <thead class="table-light">
                <tr>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">User ID</th>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">Student Name</th>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">Email Address</th>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">Auth Provider</th>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">Current Progress</th>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">Current Phase</th>
                    <th style="padding: 14px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #475569;">Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                @php
                    $dayProgressPercent = min(100, round(($u->current_day / 60) * 100));
                    $initials = strtoupper(substr($u->name, 0, 2));
                @endphp
                <tr>
                    <td style="padding: 16px;">
                        <span style="font-weight: 800; color: #1E6146; font-size: 14px;">#{{ $u->id }}</span>
                    </td>
                    <td style="padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #E8F3EE; color: #1E6146; font-weight: 800; font-size: 13px; display: flex; align-items: center; justify-content: center; border: 1px solid #A7F3D0;">
                                {{ $initials }}
                            </div>
                            <div>
                                <strong style="font-size: 14px; color: #0F172A; display: block;">{{ $u->name }}</strong>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: #334155; font-weight: 500;">
                        <i class="bi bi-envelope-at" style="color: #94A3B8; margin-right: 4px;"></i> {{ $u->email }}
                    </td>
                    <td style="padding: 16px;">
                        @if($u->provider === 'google')
                            <span class="badge" style="background: #E0F2FE; color: #0369A1; font-weight: 700; padding: 6px 12px; font-size: 12px;">
                                <i class="bi bi-google"></i> Google OAuth
                            </span>
                        @elseif($u->provider === 'apple')
                            <span class="badge" style="background: #F3F4F6; color: #111827; font-weight: 700; padding: 6px 12px; font-size: 12px;">
                                <i class="bi bi-apple"></i> Apple OAuth
                            </span>
                        @else
                            <span class="badge" style="background: #ECFDF5; color: #047857; font-weight: 700; padding: 6px 12px; font-size: 12px;">
                                <i class="bi bi-envelope-fill"></i> Email
                            </span>
                        @endif
                    </td>
                    <td style="padding: 16px; min-width: 170px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                            <span class="badge badge-green" style="font-size: 12px; font-weight: 800;">Day {{ $u->current_day }} / 60</span>
                            <span style="font-size: 11px; font-weight: 700; color: #64748B;">{{ $dayProgressPercent }}%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px; background: #E2E8F0;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $dayProgressPercent }}%; background-color: #1E6146; border-radius: 10px;" aria-valuenow="{{ $dayProgressPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td style="padding: 16px;">
                        @if($u->phase == 0)
                            <span class="badge" style="background: #F1F5F9; color: #475569; font-size: 12px; font-weight: 700;">Phase 0: Onboarding</span>
                        @elseif($u->phase == 1)
                            <span class="badge" style="background: #D1FAE5; color: #065F46; font-size: 12px; font-weight: 700;">Phase 1: Guided</span>
                        @elseif($u->phase == 2)
                            <span class="badge" style="background: #DBEAFE; color: #1E40AF; font-size: 12px; font-weight: 700;">Phase 2: Semi-Guided</span>
                        @else
                            <span class="badge" style="background: #F3E8FF; color: #6B21A8; font-size: 12px; font-weight: 700;">Phase 3: Independent</span>
                        @endif
                    </td>
                    <td style="padding: 16px; color: #64748B; font-size: 13px; font-weight: 500;">
                        <i class="bi bi-calendar3" style="margin-right: 4px; color: #94A3B8;"></i>
                        {{ $u->created_at ? $u->created_at->format('M d, Y • h:i A') : '—' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #9CA3AF; padding: 36px;">
                        <i class="bi bi-people" style="font-size: 32px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
                        No registered students match your search criteria.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 Pagination -->
    <div style="padding: 20px 4px 0 4px; display: flex; justify-content: flex-end;">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
