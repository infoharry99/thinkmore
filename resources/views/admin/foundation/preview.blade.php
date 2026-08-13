@extends('admin.layouts.app')

@section('title', 'Student Mobile App View Preview - Day ' . $day->day_number)

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <a href="{{ route('admin.foundation.index') }}" style="color: #6B7280; text-decoration: none; font-size: 14px; font-weight: 600;">
            ← Back to Foundation Program List
        </a>
        <h3 style="font-size: 22px; font-weight: 800; color: #111827; margin-top: 4px;">
            Student Mobile Experience Preview (Day {{ $day->day_number }} • "{{ $day->title }}")
        </h3>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.foundation.edit', $day->id) }}" class="btn-primary" style="background: #3B82F6;">
            <i class="bi bi-pencil-square"></i> Edit Day Content
        </a>
    </div>
</div>

<!-- Mobile Device Simulator Layout -->
<div style="display: flex; justify-content: center; padding: 20px 0;">
    <div style="width: 420px; background: #0F172A; border-radius: 40px; padding: 14px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); border: 4px solid #334155;">
        
        <!-- Phone Top Notch / Speaker -->
        <div style="display: flex; justify-content: center; margin-bottom: 12px;">
            <div style="width: 140px; height: 24px; background: #1E293B; border-bottom-left-radius: 14px; border-bottom-right-radius: 14px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <div style="width: 10px; height: 10px; border-radius: 50%; background: #0F172A;"></div>
                <div style="width: 50px; height: 4px; border-radius: 4px; background: #0F172A;"></div>
            </div>
        </div>

        <!-- Phone Screen Content -->
        <div style="background: #F8FAFC; border-radius: 28px; padding: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #1E293B; max-height: 750px; overflow-y: auto;">
            
            <!-- Mobile App Top Bar -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                <div>
                    <span style="background: #1E6146; color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 800; text-transform: uppercase;">
                        Day {{ $day->day_number }}
                    </span>
                    <span style="color: #64748B; font-size: 12px; margin-left: 6px; font-weight: 600;">
                        {{ $day->domain }}
                    </span>
                </div>
                <div style="font-size: 11px; font-weight: 700; color: #0284C7; background: #E0F2FE; padding: 3px 8px; border-radius: 10px;">
                    {{ $bundle['difficulty'] ?? 'Beginner' }}
                </div>
            </div>

            <!-- Mission Tagline & Objective -->
            <div style="background: linear-gradient(135deg, #1E6146 0%, #0F3E2B 100%); color: white; padding: 16px; border-radius: 16px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(30, 97, 70, 0.25);">
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85; font-weight: 700; margin-bottom: 4px;">
                    {{ $bundle['learning_objective'] ?? 'Day Mission' }}
                </div>
                <div style="font-size: 15px; font-weight: 700; line-height: 1.4;">
                    "{{ $bundle['mission'] ?? '' }}"
                </div>
            </div>

            <!-- Opening Scenario Card -->
            <div style="background: white; border: 1px solid #E2E8F0; padding: 16px; border-radius: 16px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                <div style="font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; text-transform: uppercase;">
                    📖 Judgment Scenario — "{{ $day->title }}"
                </div>
                <div style="font-size: 14px; line-height: 1.6; color: #334155; font-weight: 500; whitespace: pre-line;">
                    {{ $bundle['scenario_text'] ?? '' }}
                </div>
            </div>

            <!-- Steps Iteration -->
            @foreach($bundle['steps'] ?? [] as $step)
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 18px;">
                
                @if($step['key'] === 'detect')
                    <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="background: #3B82F6; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">1</span>
                        Step 1 — Detect (Separate Facts & Stories)
                    </div>
                    @if(!empty($step['insight']))
                    <div style="background: #FEF3C7; color: #78350F; padding: 10px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; line-height: 1.4; margin-bottom: 10px;">
                        💡 <strong>Insight:</strong> {{ $step['insight'] }}
                    </div>
                    @endif
                    @if(!empty($step['reference_example']))
                    <div style="background: #F1F5F9; border: 1px solid #CBD5E1; padding: 10px; border-radius: 8px; font-size: 12px; color: #334155;">
                        <strong>Reference Example:</strong><br>{{ $step['reference_example'] }}
                    </div>
                    @endif

                @elseif($step['key'] === 'decode')
                    <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="background: #8B5CF6; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">2</span>
                        Step 2 — Decode (Identify Thinking Trap)
                    </div>
                    <div style="font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 8px;">{{ $step['prompt'] ?? 'Which thinking trap is active?' }}</div>
                    
                    @foreach($step['options'] ?? [] as $opt)
                    <div style="background: {{ ($step['correct_option_key'] ?? '') === $opt['key'] ? '#ECFDF5' : '#F8FAFC' }}; border: 1.5px solid {{ ($step['correct_option_key'] ?? '') === $opt['key'] ? '#10B981' : '#E2E8F0' }}; padding: 10px; border-radius: 10px; font-size: 12px; margin-bottom: 6px; font-weight: 600;">
                        <strong>{{ $opt['label'] }}</strong>: {{ $opt['definition'] ?? '' }}
                        @if(($step['correct_option_key'] ?? '') === $opt['key'])
                            <span style="background: #10B981; color: white; font-size: 10px; padding: 2px 6px; border-radius: 6px; float: right;">Correct ✓</span>
                        @endif
                    </div>
                    @endforeach

                    @if(!empty($step['explanation']))
                    <div style="margin-top: 10px; background: #F3F4F6; padding: 10px; border-radius: 8px; font-size: 11px; color: #374151; line-height: 1.4;">
                        <strong>Explanation:</strong> {{ $step['explanation'] }}
                    </div>
                    @endif

                @elseif($step['key'] === 'reality_check')
                    <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="background: #0284C7; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">3</span>
                        Step 3 — Reality Check (Socratic Audit)
                    </div>
                    @foreach($step['inputs'] ?? [] as $inp)
                    <div style="font-size: 12px; color: #334155; margin-bottom: 4px; font-weight: 600;">• {{ $inp['prompt'] }}</div>
                    @endforeach
                    @if(!empty($step['tip']))
                    <div style="background: #E0F2FE; color: #0369A1; padding: 8px 10px; border-radius: 8px; font-size: 11px; font-weight: 600; margin-top: 8px;">
                        💡 <strong>Tip:</strong> {{ $step['tip'] }}
                    </div>
                    @endif

                @elseif($step['key'] === 'reframe')
                    <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="background: #F59E0B; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">4</span>
                        Step 4 — Reframe (Alternative Explanations)
                    </div>
                    @if(!empty($step['reference_example']))
                    <div style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px;">Model Alternative Explanations:</div>
                    <ul style="font-size: 12px; color: #334155; margin-left: 18px; line-height: 1.5;">
                        @foreach((array)$step['reference_example'] as $re)
                        <li>{{ $re }}</li>
                        @endforeach
                    </ul>
                    @endif

                @elseif($step['key'] === 'intervention')
                    <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="background: #10B981; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">5</span>
                        Step 5 — Intervention (Single Action)
                    </div>
                    <div style="background: #ECFDF5; border: 1px solid #A7F3D0; padding: 10px; border-radius: 8px; font-size: 12px; color: #065F46; font-weight: 600; line-height: 1.5;">
                        🎯 {{ $step['reference_example'] ?? 'Single thoughtful action...' }}
                    </div>

                @elseif($step['key'] === 'internalize')
                    <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="background: #EC4899; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">6</span>
                        Step 6 — Internalize (1-Line Universal Principle)
                    </div>
                    <div style="background: #FDF2F8; border: 1px solid #FBCFE8; padding: 10px; border-radius: 8px; font-size: 12px; color: #9D174D; font-weight: 700; line-height: 1.5;">
                        💡 "{{ $step['reference_example'] ?? 'Universal principle...' }}"
                    </div>
                @endif

            </div>
            @endforeach

            <!-- Closing Reflection -->
            @if(!empty($bundle['closing_reflection']))
            <div style="background: #EFF6FF; border: 1px solid #BFDBFE; padding: 16px; border-radius: 16px; margin-bottom: 12px;">
                <div style="font-size: 12px; font-weight: 800; color: #1E40AF; margin-bottom: 6px;">
                    📝 Closing Reflection
                </div>
                <div style="font-size: 13px; color: #1E3A8A; font-weight: 600; line-height: 1.4;">
                    {{ $bundle['closing_reflection']['prompt'] ?? '' }}
                </div>
            </div>
            @endif

            <!-- End of Day Walkthrough for Day 20 -->
            @if(!empty($bundle['end_of_day_walkthrough']))
            <div style="background: #F0FDF4; border: 1.5px solid #22C55E; padding: 16px; border-radius: 16px; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 800; color: #15803D; margin-bottom: 8px;">
                    🏁 Day 20 End-of-Day Walkthrough
                </div>
                <div style="font-size: 12px; color: #166534; line-height: 1.5;">
                    <strong>Traps Present:</strong> {{ implode(', ', $bundle['end_of_day_walkthrough']['traps_present'] ?? []) }}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
