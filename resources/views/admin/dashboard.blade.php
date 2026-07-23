@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-people-fill"></i> Total Enrolled Students</div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-journal-check"></i> Active Case Studies</div>
        <div class="stat-value">{{ $stats['active_cases'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-file-earmark-bar-graph"></i> 60-Day Feedbacks</div>
        <div class="stat-value">{{ $stats['total_feedbacks'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-star-fill" style="color: #F59E0B;"></i> Avg. Judgment Impact</div>
        <div class="stat-value">{{ $stats['avg_impact_score'] }} / 5</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <!-- Recent Feedbacks -->
    <div class="card-box">
        <div class="card-header-flex">
            <h3 style="font-size: 16px; font-weight: 700;">Recent Foundation Course Feedbacks (PDF 1)</h3>
            <a href="{{ route('admin.feedbacks.index') }}" style="color: #1E6146; font-size: 13px; font-weight: 600; text-decoration: none;">View All →</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Impact Rating</th>
                        <th>Technique Applied</th>
                        <th>Testimonial / Feedback</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentFeedbacks as $fb)
                    <tr>
                        <td><strong>{{ $fb->user->name ?? 'User #' . $fb->user_id }}</strong></td>
                        <td>
                            <span class="badge badge-green">★ {{ $fb->judgment_impact_score }} / 5</span>
                        </td>
                        <td>
                            <span class="badge badge-gray">{{ str_replace('_', ' ', $fb->technique_applied) }}</span>
                        </td>
                        <td style="max-width: 250px;">
                            {{ $fb->testimonial_text ?? $fb->improvement_feedback ?? '—' }}
                        </td>
                        <td style="color: #9CA3AF;">{{ $fb->submitted_at ? $fb->submitted_at->format('M d, Y') : '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #9CA3AF; padding: 24px;">No feedback submissions recorded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="card-box">
        <div class="card-header-flex">
            <h3 style="font-size: 16px; font-weight: 700;">Student Progress</h3>
            <a href="{{ route('admin.users.index') }}" style="color: #1E6146; font-size: 13px; font-weight: 600; text-decoration: none;">View All →</a>
        </div>
        <div style="padding: 16px;">
            @forelse($recentUsers as $u)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #F3F4F6;">
                <div>
                    <div style="font-weight: 600; font-size: 14px;">{{ $u->name }}</div>
                    <div style="font-size: 12px; color: #9CA3AF;">{{ $u->email }}</div>
                </div>
                <span class="badge badge-green">Day {{ $u->current_day }} / 60</span>
            </div>
            @empty
            <div style="text-align: center; color: #9CA3AF; padding: 16px;">No users enrolled yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
