@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<!-- Welcome Banner Header -->
<div class="card-box" style="padding: 28px; margin-bottom: 28px; background: linear-gradient(135deg, #1E6146 0%, #0F3E2B 100%); color: white; border: none; box-shadow: 0 10px 30px rgba(30, 97, 70, 0.25);">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="font-size: 12px; text-transform: uppercase; font-weight: 800; opacity: 0.85; letter-spacing: 0.8px; margin-bottom: 6px;">
                ⚡ ThinkClear Admin Control Center
            </div>
            <h2 style="font-size: 24px; font-weight: 800; margin: 0; color: white;">
                Welcome back, {{ Auth::user()->name }}! 👋
            </h2>
            <p style="font-size: 14px; opacity: 0.9; margin-top: 6px; margin-bottom: 0;">
                All systems running clean. Phase 1 (Days 1–20) REST APIs are active and delivering curriculum content.
            </p>
        </div>
        <div style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); padding: 12px 20px; border-radius: 14px; text-align: right; border: 1px solid rgba(255,255,255,0.2);">
            <div style="font-size: 11px; font-weight: 700; opacity: 0.8;">TODAY'S DATE</div>
            <div style="font-size: 15px; font-weight: 800;">{{ now()->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Modern Metric Stat Grid -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr);">
    
    <!-- Stat 1 -->
    <div class="stat-card" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-label"><i class="bi bi-people-fill" style="color: #10B981;"></i> Enrolled Students</div>
            <div class="stat-value" style="margin-top: 4px;">{{ $stats['total_users'] }}</div>
            <span class="badge" style="background: #ECFDF5; color: #047857; font-size: 11px; margin-top: 8px;">Active Learners</span>
        </div>
        <div style="width: 52px; height: 52px; border-radius: 16px; background: #ECFDF5; color: #10B981; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="bi bi-people"></i>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="stat-card" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-label"><i class="bi bi-calendar-check-fill" style="color: #0284C7;"></i> Foundation Days</div>
            <div class="stat-value" style="margin-top: 4px;">{{ $stats['foundation_days_count'] ?? 20 }}</div>
            <span class="badge" style="background: #E0F2FE; color: #0369A1; font-size: 11px; margin-top: 8px;">Phase 1 Days Seeded</span>
        </div>
        <div style="width: 52px; height: 52px; border-radius: 16px; background: #E0F2FE; color: #0284C7; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="bi bi-journal-text"></i>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="stat-card" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-label"><i class="bi bi-chat-quote-fill" style="color: #8B5CF6;"></i> 60-Day Feedbacks</div>
            <div class="stat-value" style="margin-top: 4px;">{{ $stats['total_feedbacks'] }}</div>
            <span class="badge" style="background: #F3E8FF; color: #6B21A8; font-size: 11px; margin-top: 8px;">Survey Submissions</span>
        </div>
        <div style="width: 52px; height: 52px; border-radius: 16px; background: #F3E8FF; color: #8B5CF6; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="bi bi-chat-square-quote"></i>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="stat-card" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-label"><i class="bi bi-star-fill" style="color: #F59E0B;"></i> Judgment Impact</div>
            <div class="stat-value" style="margin-top: 4px;">{{ $stats['avg_impact_score'] }} <span style="font-size: 16px; color: #94A3B8;">/ 5</span></div>
            <span class="badge" style="background: #FEF3C7; color: #92400E; font-size: 11px; margin-top: 8px;">Average Score</span>
        </div>
        <div style="width: 52px; height: 52px; border-radius: 16px; background: #FEF3C7; color: #F59E0B; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="bi bi-star-fill"></i>
        </div>
    </div>

</div>

<!-- Recent Data Grid -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 28px;">
    
    <!-- Recent Feedbacks Card -->
    <div class="card-box">
        <div class="card-header-flex">
            <div>
                <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Recent Student Testimonials & Feedbacks</h3>
                <span style="font-size: 12px; color: #64748B;">Latest responses from 60-Day Foundation Survey (PDF 1)</span>
            </div>
            <a href="{{ route('admin.feedbacks.index') }}" style="color: #1E6146; font-size: 13px; font-weight: 700; text-decoration: none;">View All →</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Student</th>
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
                            <span class="badge" style="background: #FEF3C7; color: #92400E; font-weight: 800;">
                                ★ {{ $fb->judgment_impact_score }} / 5
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-gray">{{ str_replace('_', ' ', $fb->technique_applied) }}</span>
                        </td>
                        <td style="max-width: 250px; font-size: 13px;">
                            {{ $fb->testimonial_text ?? $fb->improvement_feedback ?? '—' }}
                        </td>
                        <td style="color: #64748B; font-size: 12px;">{{ $fb->submitted_at ? $fb->submitted_at->format('M d, Y') : '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #94A3B8; padding: 28px;">
                            <i class="bi bi-chat-left-dots" style="font-size: 24px; display: block; margin-bottom: 6px; color: #CBD5E1;"></i>
                            No feedback submissions recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Registered Students Card -->
    <div class="card-box">
        <div class="card-header-flex">
            <div>
                <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Recent Students</h3>
                <span style="font-size: 12px; color: #64748B;">Latest registered users</span>
            </div>
            <a href="{{ route('admin.users.index') }}" style="color: #1E6146; font-size: 13px; font-weight: 700; text-decoration: none;">View All →</a>
        </div>
        <div style="padding: 18px;">
            @forelse($recentUsers as $u)
            @php $initials = strtoupper(substr($u->name, 0, 2)); @endphp
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #F1F5F9;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #E8F3EE; color: #1E6146; font-weight: 800; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                        {{ $initials }}
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 13px; color: #0F172A;">{{ $u->name }}</div>
                        <div style="font-size: 11px; color: #64748B;">{{ $u->email }}</div>
                    </div>
                </div>
                <span class="badge badge-green" style="font-size: 11px; font-weight: 700;">Day {{ $u->current_day }} / 60</span>
            </div>
            @empty
            <div style="text-align: center; color: #94A3B8; padding: 24px;">No users enrolled yet.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
