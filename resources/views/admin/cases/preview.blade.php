@extends('admin.layouts.app')

@section('title', 'Student Mobile App View Preview - Day ' . $case->day_number)

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <a href="{{ route('admin.cases.index') }}" style="color: #6B7280; text-decoration: none; font-size: 14px; font-weight: 600;">
            ← Back to Case Library
        </a>
        <h3 style="font-size: 22px; font-weight: 800; color: #111827; margin-top: 4px;">
            Student Mobile Experience Preview (Day {{ $case->day_number }} • {{ $case->case_id }})
        </h3>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.cases.edit', $case->id) }}" class="btn-primary" style="background: #3B82F6;">
            <i class="bi bi-pencil-square"></i> Edit Case
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
                        Day {{ $case->day_number }}
                    </span>
                    <span style="color: #64748B; font-size: 12px; margin-left: 6px; font-weight: 600;">
                        {{ $case->domain }}
                    </span>
                </div>
                <div style="font-size: 11px; font-weight: 700; color: #0284C7; background: #E0F2FE; padding: 3px 8px; border-radius: 10px;">
                    {{ $case->difficulty }}
                </div>
            </div>

            <!-- Mission Tagline & Objective -->
            <div style="background: linear-gradient(135deg, #1E6146 0%, #0F3E2B 100%); color: white; padding: 16px; border-radius: 16px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(30, 97, 70, 0.25);">
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85; font-weight: 700; margin-bottom: 4px;">
                    {{ $case->learning_objective ?? 'Day Mission' }}
                </div>
                <div style="font-size: 15px; font-weight: 700; line-height: 1.4;">
                    "{{ $case->mission }}"
                </div>
            </div>

            <!-- Opening Scenario Card -->
            <div style="background: white; border: 1px solid #E2E8F0; padding: 16px; border-radius: 16px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                <div style="font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; text-transform: uppercase;">
                    📖 Judgment Scenario
                </div>
                <div style="font-size: 14px; line-height: 1.6; color: #334155; font-weight: 500;">
                    {{ $case->opening_scenario }}
                </div>
            </div>

            <!-- Step 1: Detect -->
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 18px;">
                <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <span style="background: #3B82F6; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">1</span>
                    Step 1 — Detect (Separate Facts & Stories)
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Fact (What happened?)</label>
                    <div style="background: #F1F5F9; border: 1px solid #CBD5E1; padding: 10px; border-radius: 8px; font-size: 12px; color: #334155;">
                        {{ $case->step1_detect['model_fact'] ?? 'Write facts only...' }}
                    </div>
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Story (What mind creates)</label>
                    <div style="background: #F1F5F9; border: 1px solid #CBD5E1; padding: 10px; border-radius: 8px; font-size: 12px; color: #334155;">
                        {{ $case->step1_detect['model_story'] ?? 'Write story/assumptions...' }}
                    </div>
                </div>

                @if(!empty($case->step1_detect['insight']))
                <div style="background: #FEF3C7; color: #78350F; padding: 10px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; line-height: 1.4;">
                    💡 <strong>Insight:</strong> {{ $case->step1_detect['insight'] }}
                </div>
                @endif
            </div>

            <!-- Step 2: Decode -->
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 18px;">
                <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <span style="background: #8B5CF6; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">2</span>
                    Step 2 — Decode (Identify Thinking Trap)
                </div>

                <div style="font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 8px;">Which thinking trap is active?</div>

                @if(!empty($case->step2_decode['options']))
                    @foreach($case->step2_decode['options'] as $option)
                    <div style="background: {{ str_contains($option, $case->primary_trap) ? '#ECFDF5' : '#F8FAFC' }}; border: 1.5px solid {{ str_contains($option, $case->primary_trap) ? '#10B981' : '#E2E8F0' }}; padding: 10px; border-radius: 10px; font-size: 12px; margin-bottom: 6px; font-weight: 600; color: {{ str_contains($option, $case->primary_trap) ? '#065F46' : '#475569' }}; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ $option }}</span>
                        @if(str_contains($option, $case->primary_trap))
                            <span style="background: #10B981; color: white; font-size: 10px; padding: 2px 6px; border-radius: 6px;">Correct ✓</span>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div style="background: #ECFDF5; border: 1.5px solid #10B981; padding: 10px; border-radius: 10px; font-size: 12px; font-weight: 700; color: #065F46;">
                        ☑ {{ $case->primary_trap }}
                    </div>
                @endif

                @if(!empty($case->step2_decode['explanation']))
                <div style="margin-top: 10px; background: #F3F4F6; padding: 10px; border-radius: 8px; font-size: 11px; color: #374151; line-height: 1.4;">
                    <strong>Explanation:</strong> {{ $case->step2_decode['explanation'] }}
                </div>
                @endif
            </div>

            <!-- Step 3: Reality Check -->
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 18px;">
                <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <span style="background: #0284C7; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">3</span>
                    Step 3 — Reality Check (Socratic Audit)
                </div>

                <ul style="font-size: 12px; color: #334155; margin-left: 18px; margin-bottom: 10px; line-height: 1.6;">
                    <li>1. What fact do you know for certain?</li>
                    <li>2. What are you assuming?</li>
                    <li>3. What evidence supports your assumption?</li>
                    <li>4. What evidence contradicts it?</li>
                    <li>5. What advice would you give a friend?</li>
                </ul>

                @if(!empty($case->step3_reality_check['tip']))
                <div style="background: #E0F2FE; color: #0369A1; padding: 8px 10px; border-radius: 8px; font-size: 11px; font-weight: 600;">
                    💡 <strong>Tip:</strong> {{ $case->step3_reality_check['tip'] }}
                </div>
                @endif
            </div>

            <!-- Step 4: Reframe -->
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 18px;">
                <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <span style="background: #F59E0B; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">4</span>
                    Step 4 — Reframe (Alternative Explanations)
                </div>

                @if(!empty($case->step4_reframe['model_reframe']))
                <div style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px;">Alternative Model Explanations:</div>
                <ul style="font-size: 12px; color: #334155; margin-left: 18px; margin-bottom: 8px; line-height: 1.5;">
                    @foreach($case->step4_reframe['model_reframe'] as $alt)
                    <li>{{ $alt }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <!-- Step 5: Intervention -->
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 18px;">
                <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <span style="background: #10B981; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">5</span>
                    Step 5 — Intervention (Single Action)
                </div>

                <div style="background: #ECFDF5; border: 1px solid #A7F3D0; padding: 10px; border-radius: 8px; font-size: 12px; color: #065F46; font-weight: 600; line-height: 1.5;">
                    🎯 {{ $case->step5_intervention['model_action'] ?? 'Single reasonable action...' }}
                </div>
            </div>

            <!-- Step 6: Internalize -->
            <div style="background: white; border: 1.5px solid #CBD5E1; padding: 16px; border-radius: 16px; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <span style="background: #EC4899; color: white; width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px;">6</span>
                    Step 6 — Internalize (1-Line Universal Principle)
                </div>

                <div style="background: #FDF2F8; border: 1px solid #FBCFE8; padding: 10px; border-radius: 8px; font-size: 12px; color: #9D174D; font-weight: 700; line-height: 1.5;">
                    💡 "{{ $case->step6_internalize['model_principle'] ?? 'Universal principle...' }}"
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
