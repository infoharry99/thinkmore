@extends('admin.layouts.app')

@section('title', 'Foundation Course Feedback Survey Reports (PDF 1)')

@section('content')
<div class="card-box">
    <div class="card-header-flex">
        <h3 style="font-size: 16px; font-weight: 700;">60-Day Foundation Course Feedbacks</h3>
        
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.feedbacks.index') }}" style="display: flex; gap: 8px;">
            <select name="score" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #D1D5DB; font-size: 13px;">
                <option value="">All Impact Ratings</option>
                <option value="5" {{ request()->score == '5' ? 'selected' : '' }}>5 Stars - Very significantly</option>
                <option value="4" {{ request()->score == '4' ? 'selected' : '' }}>4 Stars - Significantly</option>
                <option value="3" {{ request()->score == '3' ? 'selected' : '' }}>3 Stars - Moderately</option>
                <option value="2" {{ request()->score == '2' ? 'selected' : '' }}>2 Stars - Slightly</option>
                <option value="1" {{ request()->score == '1' ? 'selected' : '' }}>1 Star - Not at all</option>
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Q1: Impact Score</th>
                    <th>Q2: Technique Applied</th>
                    <th>Q3: Recommend Score</th>
                    <th>Conditional Testimonial (Score ≥ 4) / Feedback (Score ≤ 2)</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $fb)
                <tr>
                    <td>{{ $fb->id }}</td>
                    <td><strong>{{ $fb->user->name ?? 'User #' . $fb->user_id }}</strong><br><span style="font-size: 12px; color: #9CA3AF;">{{ $fb->user->email ?? '' }}</span></td>
                    <td>
                        <span class="badge badge-green">★ {{ $fb->judgment_impact_score }} / 5</span>
                    </td>
                    <td>
                        <span class="badge badge-gray">{{ str_replace('_', ' ', $fb->technique_applied) }}</span>
                    </td>
                    <td>
                        <span class="badge badge-gray">★ {{ $fb->recommend_score }} / 5</span>
                    </td>
                    <td style="max-width: 320px;">
                        @if($fb->judgment_impact_score >= 4 && $fb->testimonial_text)
                            <div style="background: #E8F3EE; color: #1E6146; padding: 8px 12px; border-radius: 8px; font-size: 13px;">
                                <strong>Testimonial:</strong> "{{ $fb->testimonial_text }}"
                            </div>
                        @elseif($fb->judgment_impact_score <= 2 && $fb->improvement_feedback)
                            <div style="background: #FEF2F2; color: #991B1B; padding: 8px 12px; border-radius: 8px; font-size: 13px;">
                                <strong>Improvement:</strong> "{{ $fb->improvement_feedback }}"
                            </div>
                        @else
                            <span style="color: #9CA3AF;">—</span>
                        @endif
                    </td>
                    <td style="color: #9CA3AF;">{{ $fb->submitted_at ? $fb->submitted_at->format('M d, Y H:i') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #9CA3AF; padding: 24px;">No feedback submissions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 16px 24px;">
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection
