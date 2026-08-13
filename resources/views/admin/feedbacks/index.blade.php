@extends('admin.layouts.app')

@section('title', 'Foundation Course Feedback Survey Reports (PDF 1)')

@section('content')
<div class="card-box" style="padding: 28px;">
    <!-- Top Action Header -->
    <div class="card-header-flex" style="margin-bottom: 20px;">
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: #111827; margin: 0;">60-Day Foundation Survey Submissions</h3>
            <p style="font-size: 13px; color: #6B7280; margin-top: 4px;">Review student ratings, judgment impact scores, technique adoption, and conditional testimonials.</p>
        </div>
        <div>
            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.feedbacks.index') }}" style="display: flex; gap: 8px;">
                <select name="score" onchange="this.form.submit()" class="form-select" style="border-radius: 10px; font-size: 13px; font-weight: 600;">
                    <option value="">All Impact Ratings</option>
                    <option value="5" {{ request()->score == '5' ? 'selected' : '' }}>5 Stars — Very Significantly</option>
                    <option value="4" {{ request()->score == '4' ? 'selected' : '' }}>4 Stars — Significantly</option>
                    <option value="3" {{ request()->score == '3' ? 'selected' : '' }}>3 Stars — Moderately</option>
                    <option value="2" {{ request()->score == '2' ? 'selected' : '' }}>2 Stars — Slightly</option>
                    <option value="1" {{ request()->score == '1' ? 'selected' : '' }}>1 Star — Not At All</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 Table Layout -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Student Details</th>
                    <th>Impact Score (Q1)</th>
                    <th>Technique Applied (Q2)</th>
                    <th>Recommend Score (Q3)</th>
                    <th>Conditional Testimonial (Score ≥ 4) / Improvement (Score ≤ 2)</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $fb)
                @php $initials = strtoupper(substr($fb->user->name ?? 'US', 0, 2)); @endphp
                <tr>
                    <td><strong>#{{ $fb->id }}</strong></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #E8F3EE; color: #1E6146; font-weight: 800; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                {{ $initials }}
                            </div>
                            <div>
                                <strong style="font-size: 14px; color: #0F172A;">{{ $fb->user->name ?? 'User #' . $fb->user_id }}</strong><br>
                                <span style="font-size: 12px; color: #64748B;">{{ $fb->user->email ?? '' }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($fb->judgment_impact_score >= 4)
                            <span class="badge" style="background: #FEF3C7; color: #92400E; font-weight: 800; font-size: 13px;">
                                ★ {{ $fb->judgment_impact_score }} / 5
                            </span>
                        @elseif($fb->judgment_impact_score == 3)
                            <span class="badge" style="background: #E0F2FE; color: #0369A1; font-weight: 800; font-size: 13px;">
                                ★ {{ $fb->judgment_impact_score }} / 5
                            </span>
                        @else
                            <span class="badge" style="background: #FEE2E2; color: #991B1B; font-weight: 800; font-size: 13px;">
                                ★ {{ $fb->judgment_impact_score }} / 5
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-gray">{{ str_replace('_', ' ', $fb->technique_applied) }}</span>
                    </td>
                    <td>
                        <span class="badge badge-gray" style="font-size: 13px;">★ {{ $fb->recommend_score }} / 5</span>
                    </td>
                    <td style="max-width: 320px;">
                        @if($fb->judgment_impact_score >= 4 && $fb->testimonial_text)
                            <div style="background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; padding: 10px 14px; border-radius: 10px; font-size: 13px; font-weight: 500; line-height: 1.4;">
                                💬 <strong>Testimonial:</strong> "{{ $fb->testimonial_text }}"
                            </div>
                        @elseif($fb->judgment_impact_score <= 2 && $fb->improvement_feedback)
                            <div style="background: #FEF2F2; color: #991B1B; border: 1px solid #FCA5A5; padding: 10px 14px; border-radius: 10px; font-size: 13px; font-weight: 500; line-height: 1.4;">
                                ⚠️ <strong>Improvement:</strong> "{{ $fb->improvement_feedback }}"
                            </div>
                        @else
                            <span style="color: #94A3B8;">—</span>
                        @endif
                    </td>
                    <td style="color: #64748B; font-size: 13px;">{{ $fb->submitted_at ? $fb->submitted_at->format('M d, Y • h:i A') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #94A3B8; padding: 36px;">
                        <i class="bi bi-chat-square-quote" style="font-size: 32px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
                        No feedback submissions found matching your filter criteria.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 Pagination -->
    <div style="padding: 20px 4px 0 4px; display: flex; justify-content: flex-end;">
        {{ $feedbacks->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
