<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseStudy;

class Day1To20CaseSeeder extends Seeder
{
    /**
     * Seed Phase 1 Judgment Scenarios (Days 1 to 20)
     */
    public function run(): void
    {
        $cases = [
            // Day 1
            [
                'day_number' => 1,
                'case_id' => 'P1-001',
                'domain' => 'Relationships',
                'primary_trap' => 'Mind Reading',
                'secondary_trap' => null,
                'difficulty' => 'Beginner',
                'primary_skill' => 'Detect',
                'mission' => 'Don\'t let your mind write the story before the facts.',
                'learning_objective' => 'Separate Facts from Stories',
                'phase_target' => 1,
                'trap_target' => ['Mind Reading'],
                'opening_scenario' => 'Ananya sends her husband a message during lunch asking him to call when he is free. He reads the message. Three hours pass. There is still no reply.',
                'step1_detect' => [
                    'fact_prompt' => 'Write only the facts.',
                    'story_prompt' => 'Now write the story/assumptions your mind is creating.',
                    'insight' => 'Your brain creates stories automatically. Your first responsibility is to separate them from facts.',
                    'model_fact' => 'He read my message three hours ago and hasn\'t replied.',
                    'model_story' => 'He is upset with me and is ignoring me.'
                ],
                'step2_decode' => [
                    'options' => [
                        'Catastrophizing - Assuming the absolute worst outcome.',
                        'Mind Reading - Assuming others\' intentions without evidence.',
                        'Emotional Reasoning - Treating a feeling as proof of reality.'
                    ],
                    'correct_trap' => 'Mind Reading',
                    'explanation' => 'The only confirmed fact is that there has been no reply. The story is that he is upset and deliberately ignoring her. There is no evidence to support that conclusion.'
                ],
                'step3_reality_check' => [
                    'q1' => 'What fact do you know for certain?',
                    'q2' => 'What are you assuming?',
                    'q3' => 'What evidence supports your assumption?',
                    'q4' => 'What evidence contradicts it?',
                    'q5' => 'If someone else described this situation, what would you tell them?',
                    'tip' => 'Ask "What happened?" before asking "How are you feeling?" or "What\'s bothering you?"'
                ],
                'step4_reframe' => [
                    'prompt' => 'Write at least 3 other explanations that also fit the facts.',
                    'model_reframe' => [
                        'He got busy at work.',
                        'He planned to reply later and forgot.',
                        'He is driving.',
                        'His phone battery died.'
                    ],
                    'challenge_prompt' => 'Can you think of one more explanation that also fits the facts?'
                ],
                'step5_intervention' => [
                    'prompt' => 'Based on the evidence available, what is one thoughtful action you can take?',
                    'model_action' => 'Wait until the end of the workday. If there is still no reply, send one calm message: "Just checking if everything is okay. Call me when you\'re free."',
                    'reminder' => 'There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available.'
                ],
                'step6_internalize' => [
                    'prompt' => 'Complete this sentence: "Today I learned that..."',
                    'model_principle' => 'A delayed reply is a fact. Being ignored is a story/assumptions until evidence proves otherwise.',
                    'closing_reflection' => 'Where else in my life might I be confusing facts with stories?'
                ],
                'developer_notes' => [
                    'primary_skill' => 'Detect',
                    'primary_trap' => 'Mind Reading',
                    'difficulty' => 'Beginner',
                    'estimated_time' => '3–5 minutes'
                ],
            ],

            // Day 2
            [
                'day_number' => 2,
                'case_id' => 'P1-002',
                'domain' => 'Workplace',
                'primary_trap' => 'Fortune Telling',
                'secondary_trap' => null,
                'difficulty' => 'Beginner',
                'primary_skill' => 'Decode',
                'mission' => 'Don\'t predict the future without evidence.',
                'learning_objective' => 'Recognize Thinking Traps',
                'phase_target' => 1,
                'trap_target' => ['Fortune Telling'],
                'opening_scenario' => 'At 8:15 PM, your manager sends you a message: "Let\'s meet tomorrow morning." There is no agenda. No explanation. No follow-up message. You spend the rest of the evening wondering what the meeting is about.',
                'step1_detect' => [
                    'fact_prompt' => 'Write only the facts.',
                    'story_prompt' => 'Now write the story your mind is creating.',
                    'insight' => 'Your mind naturally tries to predict what happens next. Predictions are not facts.',
                    'model_fact' => 'My manager asked to meet me tomorrow morning.',
                    'model_story' => 'I\'m probably in trouble or about to receive negative feedback.'
                ],
                'step2_decode' => [
                    'options' => [
                        'Fortune Telling - Treating an unverified prediction as certain.',
                        'Mind Reading - Assuming others\' intentions without evidence.',
                        'Catastrophizing - Assuming the absolute worst outcome.'
                    ],
                    'correct_trap' => 'Fortune Telling',
                    'explanation' => 'Nothing has happened yet. Your mind has filled in the missing information by predicting an outcome without evidence.'
                ],
                'step3_reality_check' => [
                    'q1' => 'What fact do you know for certain?',
                    'q2' => 'What are you assuming?',
                    'q3' => 'What evidence supports your assumption?',
                    'q4' => 'What evidence contradicts it?',
                    'q5' => 'If someone else described this situation, what would you tell them?',
                    'tip' => 'Ask "What happened?" before asking "How are you feeling?" or "What\'s bothering you?"'
                ],
                'step4_reframe' => [
                    'prompt' => 'Write at least 3 other explanations that also fit the facts.',
                    'model_reframe' => [
                        'The manager wants to discuss a new project.',
                        'The meeting is part of a routine review.',
                        'The manager needs your input on an upcoming task.',
                        'The manager prefers discussing something in person rather than over messages.'
                    ],
                    'challenge_prompt' => 'Can you think of one positive possibility that also fits the facts?'
                ],
                'step5_intervention' => [
                    'prompt' => 'Based on the evidence available, what is one thoughtful action you can take?',
                    'model_action' => 'Avoid jumping to conclusions. Prepare for the meeting as you normally would and wait until you have more information before interpreting the situation.',
                    'reminder' => 'There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available.'
                ],
                'step6_internalize' => [
                    'prompt' => 'Complete this sentence: "Today I learned that..."',
                    'model_principle' => 'An uncertain future is not evidence. Predictions should never be treated as facts.',
                    'closing_reflection' => 'Where else today might I be predicting an outcome without enough evidence?'
                ],
                'developer_notes' => [
                    'primary_skill' => 'Decode',
                    'primary_trap' => 'Fortune Telling',
                    'difficulty' => 'Beginner',
                    'estimated_time' => '3–5 minutes'
                ],
            ],

            // Day 3
            [
                'day_number' => 3,
                'case_id' => 'P1-003',
                'domain' => 'Family',
                'primary_trap' => 'Emotional Reasoning',
                'secondary_trap' => null,
                'difficulty' => 'Beginner',
                'primary_skill' => 'Reality Check',
                'mission' => 'Feelings are real. Conclusions need evidence.',
                'learning_objective' => 'Test Assumptions with Evidence',
                'phase_target' => 1,
                'trap_target' => ['Emotional Reasoning'],
                'opening_scenario' => 'During dinner, your father answers your question with just one word. He doesn\'t smile. He quietly continues eating. The rest of the family continues talking normally. You suddenly feel that he is upset with you.',
                'step1_detect' => [
                    'fact_prompt' => 'Write only the facts.',
                    'story_prompt' => 'Now write the story your mind is creating.',
                    'insight' => 'Your feelings may be genuine. But feelings are not evidence. Always separate what happened from what you believe it means.',
                    'model_fact' => 'My father answered briefly during dinner and didn\'t smile.',
                    'model_story' => 'He must be angry with me.'
                ],
                'step2_decode' => [
                    'options' => [
                        'Mind Reading - Assuming others\' intentions without evidence.',
                        'Emotional Reasoning - Treating a feeling as proof of reality.',
                        'Catastrophizing - Assuming the absolute worst outcome.'
                    ],
                    'correct_trap' => 'Emotional Reasoning',
                    'explanation' => 'Feeling worried doesn\'t automatically mean something is wrong. The feeling is real. The conclusion still needs evidence.'
                ],
                'step3_reality_check' => [
                    'q1' => 'What fact do you know for certain?',
                    'q2' => 'What are you assuming?',
                    'q3' => 'What evidence supports your assumption?',
                    'q4' => 'What evidence contradicts it?',
                    'q5' => 'If someone else described this situation, what would you tell them?',
                    'tip' => 'Ask "What happened?" before asking "How are you feeling?" or "What\'s bothering you?"'
                ],
                'step4_reframe' => [
                    'prompt' => 'Write at least 3 other explanations that also fit the facts.',
                    'model_reframe' => [
                        'He had a tiring day.',
                        'He is thinking about something unrelated.',
                        'He isn\'t feeling physically well.',
                        'He simply isn\'t in the mood to talk much today.'
                    ],
                    'challenge_prompt' => 'Can you think of one explanation that has nothing to do with you?'
                ],
                'step5_intervention' => [
                    'prompt' => 'Based on the evidence available, what is one thoughtful action you can take?',
                    'model_action' => 'Rather than assuming something is wrong, wait for an appropriate moment and calmly ask: "You seemed quieter than usual today. Is everything okay?" Then listen without assuming the answer.',
                    'reminder' => 'There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available.'
                ],
                'step6_internalize' => [
                    'prompt' => 'Complete this sentence: "Today I learned that..."',
                    'model_principle' => 'Feeling worried doesn\'t prove that something is wrong. Feelings deserve attention, but conclusions require evidence.',
                    'closing_reflection' => 'Where else in my life have I mistaken a feeling for a fact?'
                ],
                'developer_notes' => [
                    'primary_skill' => 'Reality Check',
                    'primary_trap' => 'Emotional Reasoning',
                    'difficulty' => 'Beginner',
                    'estimated_time' => '3–5 minutes'
                ],
            ],

            // Day 4
            [
                'day_number' => 4,
                'case_id' => 'P1-004',
                'domain' => 'Health',
                'primary_trap' => 'Catastrophizing',
                'secondary_trap' => null,
                'difficulty' => 'Beginner',
                'primary_skill' => 'Reframe',
                'mission' => 'One possibility is not the only possibility.',
                'learning_objective' => 'Generate Alternative Explanations',
                'phase_target' => 1,
                'trap_target' => ['Catastrophizing'],
                'opening_scenario' => 'You notice a small lump on your neck. It isn\'t painful. You search your symptoms online. By the time you stop reading, you\'re convinced something is seriously wrong.',
                'step1_detect' => [
                    'fact_prompt' => 'Write only the facts.',
                    'story_prompt' => 'Now write the story your mind is creating.',
                    'insight' => 'When information is incomplete, your brain often fills the gaps with the worst possible explanation. That doesn\'t make it true.',
                    'model_fact' => 'I noticed a small lump on my neck and searched for it online.',
                    'model_story' => 'I probably have a serious illness.'
                ],
                'step2_decode' => [
                    'options' => [
                        'Catastrophizing - Assuming the absolute worst outcome.',
                        'Fortune Telling - Treating an unverified prediction as certain.',
                        'Confirmation Bias - Only seeing details that confirm the feared story.'
                    ],
                    'correct_trap' => 'Catastrophizing',
                    'explanation' => 'Finding one possible explanation online doesn\'t mean it is the correct explanation. Your mind has immediately jumped to the worst-case scenario without sufficient evidence.'
                ],
                'step3_reality_check' => [
                    'q1' => 'What fact do you know for certain?',
                    'q2' => 'What are you assuming?',
                    'q3' => 'What evidence supports your assumption?',
                    'q4' => 'What evidence contradicts it?',
                    'q5' => 'If someone else described this situation, what would you tell them?',
                    'tip' => 'Ask "What happened?" before asking "What could happen?"'
                ],
                'step4_reframe' => [
                    'prompt' => 'Write at least 3 other explanations that also fit the facts.',
                    'model_reframe' => [
                        'It could be a swollen lymph node caused by a minor infection.',
                        'It could be a harmless cyst.',
                        'It could be temporary and disappear in a few days.',
                        'A healthcare professional can assess it properly.'
                    ],
                    'challenge_prompt' => 'Can you think of one explanation that is less serious than your first thought?'
                ],
                'step5_intervention' => [
                    'prompt' => 'Based on the evidence available, what is one thoughtful action you can take?',
                    'model_action' => 'Instead of assuming the worst, make an appointment with a qualified healthcare professional and avoid drawing conclusions based only on internet searches.',
                    'reminder' => 'There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available.'
                ],
                'step6_internalize' => [
                    'prompt' => 'Complete this sentence: "Today I learned that..."',
                    'model_principle' => 'The worst possible explanation is only one possibility—not a conclusion.',
                    'closing_reflection' => 'Where else in my life have I assumed the worst before gathering enough evidence?'
                ],
                'developer_notes' => [
                    'primary_skill' => 'Reframe',
                    'primary_trap' => 'Catastrophizing',
                    'difficulty' => 'Beginner',
                    'estimated_time' => '3–5 minutes'
                ],
            ],

            // Day 5
            [
                'day_number' => 5,
                'case_id' => 'P1-005',
                'domain' => 'Career',
                'primary_trap' => 'Confirmation Bias',
                'secondary_trap' => null,
                'difficulty' => 'Beginner',
                'primary_skill' => 'Intervention',
                'mission' => 'Don\'t look only for evidence that supports your belief.',
                'learning_objective' => 'Choose Thoughtful Actions',
                'phase_target' => 1,
                'trap_target' => ['Confirmation Bias'],
                'opening_scenario' => 'Your manager announces that a colleague has been promoted. You had also applied for the same position. As the day goes on, you begin replaying past conversations with your manager. You start remembering only the moments that make you feel you were overlooked.',
                'step1_detect' => [
                    'fact_prompt' => 'Write only the facts.',
                    'story_prompt' => 'Now write the story your mind is creating.',
                    'insight' => 'Once your brain believes a story, it naturally starts collecting evidence to support it. That doesn\'t mean the story is true.',
                    'model_fact' => 'A colleague received the promotion.',
                    'model_story' => 'My manager doesn\'t value my work and passed me over unfairly.'
                ],
                'step2_decode' => [
                    'options' => [
                        'Mind Reading - Assuming others\' intentions without evidence.',
                        'Confirmation Bias - Only seeing details that confirm the feared story.',
                        'All-or-Nothing Thinking - Treating a minor gap as total failure.'
                    ],
                    'correct_trap' => 'Confirmation Bias',
                    'explanation' => 'Instead of considering all the available information, your mind has started collecting only the memories that support your belief that you were unfairly treated.'
                ],
                'step3_reality_check' => [
                    'q1' => 'What fact do you know for certain?',
                    'q2' => 'What are you assuming?',
                    'q3' => 'What evidence supports your assumption?',
                    'q4' => 'What evidence might contradict your assumption?',
                    'q5' => 'If someone else described this situation, what would you tell them?',
                    'tip' => 'Ask yourself, "What evidence am I ignoring?" before deciding you\'re right.'
                ],
                'step4_reframe' => [
                    'prompt' => 'Write at least 3 other explanations that also fit the facts.',
                    'model_reframe' => [
                        'The promoted colleague may have had additional experience.',
                        'The decision may have been based on skills needed for that specific role.',
                        'Your manager may value your work but believe you need more experience.',
                        'There may have been selection criteria you were unaware of.'
                    ],
                    'challenge_prompt' => 'Can you think of one explanation that doesn\'t support your current belief?'
                ],
                'step5_intervention' => [
                    'prompt' => 'Based on the evidence available, what is one thoughtful action you can take?',
                    'model_action' => 'Instead of assuming the reason, schedule a meeting with your manager and ask for constructive feedback. Focus on understanding what skills would strengthen your chances in the future.',
                    'reminder' => 'There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available.'
                ],
                'step6_internalize' => [
                    'prompt' => 'Complete this sentence: "Today I learned that..."',
                    'model_principle' => 'Looking for evidence that supports my belief is easy. Looking for evidence that challenges it requires judgment.',
                    'closing_reflection' => 'Where else in my life might I be noticing only the evidence that supports what I already believe?'
                ],
                'developer_notes' => [
                    'primary_skill' => 'Intervention',
                    'primary_trap' => 'Confirmation Bias',
                    'difficulty' => 'Beginner',
                    'estimated_time' => '3–5 minutes'
                ],
            ],

            // Days 6-20 added in loop...
        ];

        // Add Remaining Days 6-20 programmatically to ensure complete curriculum seeding
        for ($day = 6; $day <= 20; $day++) {
            $cases[] = $this->getScenarioDataForDay($day);
        }

        foreach ($cases as $c) {
            CaseStudy::updateOrCreate(
                ['case_id' => $c['case_id']],
                $c
            );
        }
    }

    private function getScenarioDataForDay(int $day): array
    {
        $data = [
            6 => [
                'case_id' => 'P1-006',
                'domain' => 'Parenting',
                'primary_trap' => 'Rumination',
                'difficulty' => 'Beginner',
                'primary_skill' => 'Internalize',
                'mission' => 'Learn from the situation. Don\'t live inside it.',
                'learning_objective' => 'Internalize the Thinking Process',
                'opening_scenario' => 'Your child comes home with a note from school. It says they were talking during class despite repeated warnings. That evening, you keep replaying the incident in your mind. You begin wondering if you\'re a bad parent.',
                'correct_trap' => 'Rumination',
                'trap_options' => ['Rumination - Repetitive, circular overthinking.', 'Catastrophizing', 'All-or-Nothing Thinking'],
                'model_fact' => 'The school informed me that my child was talking during class.',
                'model_story' => 'I\'m failing as a parent and my child is becoming difficult.',
                'model_action' => 'Speak calmly with your child to understand what happened. If needed, discuss the situation with the teacher.',
                'model_principle' => 'Replaying the same event doesn\'t always produce new answers. Judgment improves when I move from overthinking to understanding.',
                'closing_reflection' => 'What situation have I been replaying without gaining any new understanding?'
            ],
            7 => [
                'case_id' => 'P1-007',
                'domain' => 'Business',
                'primary_trap' => 'Mind Reading',
                'difficulty' => 'Beginner–Intermediate',
                'primary_skill' => 'Detect',
                'mission' => 'Separate observations from interpretations.',
                'learning_objective' => 'Separate Facts from Stories',
                'opening_scenario' => 'You sent a business proposal to an important client. Four days have passed. They have viewed your message but haven\'t replied. You begin wondering whether you\'ve lost the client.',
                'correct_trap' => 'Mind Reading',
                'trap_options' => ['Mind Reading - Assuming others\' intentions.', 'Fortune Telling', 'Confirmation Bias'],
                'model_fact' => 'The client viewed my proposal four days ago and hasn\'t replied.',
                'model_story' => 'The client didn\'t like my proposal and decided not to work with me.',
                'model_action' => 'Send a polite follow-up message: "Hello, just checking whether you\'ve had a chance to review the proposal."',
                'model_principle' => 'Silence is a fact. The meaning I attach to that silence is a story until evidence proves otherwise.',
                'closing_reflection' => 'Where else today have I assumed someone\'s intention without actually knowing it?'
            ],
            8 => [
                'case_id' => 'P1-008',
                'domain' => 'Finance',
                'primary_trap' => 'Validation Seeking',
                'difficulty' => 'Beginner–Intermediate',
                'primary_skill' => 'Decode',
                'mission' => 'Don\'t let someone else\'s opinion become your only measure of your worth.',
                'learning_objective' => 'Recognize Thinking Traps',
                'opening_scenario' => 'After several interview rounds, you finally receive a job offer. The salary offered is lower than you expected. You immediately begin wondering: "Maybe this is all I\'m worth."',
                'correct_trap' => 'Validation Seeking',
                'trap_options' => ['Validation Seeking - Heavy reliance on external acknowledgment.', 'All-or-Nothing Thinking', 'Confirmation Bias'],
                'model_fact' => 'I received a job offer with a lower salary than I expected.',
                'model_story' => 'The company thinks I\'m not valuable enough.',
                'model_action' => 'Review the complete offer objectively, research market salaries, and negotiate respectfully based on experience.',
                'model_principle' => 'External feedback provides information. It does not determine my worth.',
                'closing_reflection' => 'Where else have I allowed someone else\'s opinion to define how I see myself?'
            ],
            9 => [
                'case_id' => 'P1-009',
                'domain' => 'Workplace',
                'primary_trap' => 'Confirmation Bias',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Reality Check',
                'mission' => 'Verify before you conclude.',
                'learning_objective' => 'Test Assumptions with Evidence',
                'opening_scenario' => 'You arrive at work and notice several colleagues discussing a meeting that happened yesterday. You weren\'t invited. You immediately wonder whether you are being excluded.',
                'correct_trap' => 'Confirmation Bias',
                'trap_options' => ['Confirmation Bias - Only seeing details that confirm feared story.', 'Mind Reading', 'Fortune Telling'],
                'model_fact' => 'A meeting took place yesterday, and I wasn\'t present.',
                'model_story' => 'I\'m being excluded because my manager no longer values my contribution.',
                'model_action' => 'Ask your manager: "I heard there was a meeting yesterday. Could you help me understand what it was about?"',
                'model_principle' => 'When information is missing, my first responsibility is to gather facts—not create explanations.',
                'closing_reflection' => 'Where else have I filled gaps in information with my own explanation?'
            ],
            10 => [
                'case_id' => 'P1-010',
                'domain' => 'Relationships',
                'primary_trap' => 'Fortune Telling',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Reframe',
                'mission' => 'One event can have many explanations.',
                'learning_objective' => 'Generate Alternative Explanations',
                'opening_scenario' => 'You and your partner planned dinner. An hour before, they message: "I\'m really sorry. Can we do this another day?" No explanation is given.',
                'correct_trap' => 'Fortune Telling',
                'trap_options' => ['Fortune Telling - Treating an unverified prediction as certain.', 'Mind Reading', 'Catastrophizing'],
                'model_fact' => 'My partner cancelled our dinner plans and asked to meet another day.',
                'model_story' => 'Our relationship is changing, and they don\'t want to spend time with me.',
                'model_action' => 'Reply calmly: "No problem. Let me know when you\'re free, and we\'ll plan another day."',
                'model_principle' => 'One cancelled plan does not predict the future of a relationship.',
                'closing_reflection' => 'Where else have I treated one event as proof of what will happen next?'
            ],
            11 => [
                'case_id' => 'P1-011',
                'domain' => 'Career',
                'primary_trap' => 'Sunk Cost Fallacy',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Intervention',
                'mission' => 'Past investment should not decide future decisions.',
                'learning_objective' => 'Choose Thoughtful Actions',
                'opening_scenario' => 'Six months ago, you enrolled in a certification course. You\'ve attended few sessions and no longer enjoy it. But you keep thinking about the time and money already invested.',
                'correct_trap' => 'Sunk Cost Fallacy',
                'trap_options' => ['Sunk Cost Fallacy - Continuing because of past investment.', 'Confirmation Bias', 'Rumination'],
                'model_fact' => 'I enrolled in the course six months ago and no longer enjoy it.',
                'model_story' => 'Stopping now means I wasted my time and money.',
                'model_action' => 'Evaluate your career goals today. Make a deliberate decision rather than continuing only because of past investment.',
                'model_principle' => 'Past investment deserves respect, but future decisions should be guided by future value.',
                'closing_reflection' => 'What decision in my life am I continuing mainly because of past investment?'
            ],
            12 => [
                'case_id' => 'P1-012',
                'domain' => 'Family',
                'primary_trap' => 'All-or-Nothing Thinking',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Internalize',
                'mission' => 'One mistake doesn\'t define the whole story.',
                'learning_objective' => 'Internalize the Thinking Process',
                'opening_scenario' => 'Your brother forgets your birthday. He doesn\'t call or message. By the end of the day, you think: "He doesn\'t care about me anymore."',
                'correct_trap' => 'All-or-Nothing Thinking',
                'trap_options' => ['All-or-Nothing Thinking - Treating a minor gap as total failure.', 'Mind Reading', 'Emotional Reasoning'],
                'model_fact' => 'My brother didn\'t wish me on my birthday.',
                'model_story' => 'He doesn\'t care about me anymore.',
                'model_action' => 'Speak with your brother: "I missed hearing from you on my birthday. I wanted to check if everything is okay."',
                'model_principle' => 'One disappointing moment does not define an entire relationship.',
                'closing_reflection' => 'Where else have I allowed one event to shape my opinion of an entire person?'
            ],
            13 => [
                'case_id' => 'P1-013',
                'domain' => 'Health',
                'primary_trap' => 'Emotional Reasoning',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Detect',
                'mission' => 'A feeling is a signal, not a conclusion.',
                'learning_objective' => 'Separate Facts from Stories',
                'opening_scenario' => 'Your doctor advises a routine blood test. Results take two days. You feel anxious and think: "If I\'m this worried, something must be seriously wrong."',
                'correct_trap' => 'Emotional Reasoning',
                'trap_options' => ['Emotional Reasoning - Treating feeling as proof.', 'Catastrophizing', 'Fortune Telling'],
                'model_fact' => 'My doctor advised a blood test, and the report will be ready in two days.',
                'model_story' => 'Because I feel anxious, the report will show something serious.',
                'model_action' => 'Wait for the test results before reaching conclusions. Continue normal plans.',
                'model_principle' => 'Feeling anxious doesn\'t tell me what the result will be. Evidence deserves my decisions.',
                'closing_reflection' => 'When was the last time I treated a feeling as if it were evidence?'
            ],
            14 => [
                'case_id' => 'P1-014',
                'domain' => 'Career',
                'primary_trap' => 'Fortune Telling',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Decode',
                'mission' => 'Predictions are not evidence.',
                'learning_objective' => 'Recognize Thinking Traps',
                'opening_scenario' => 'You attend a job interview that goes well. They say they\'ll get back in 5 days. 7 days pass with no email or call. You think: "I didn\'t get the job."',
                'correct_trap' => 'Fortune Telling',
                'trap_options' => ['Fortune Telling - Treating prediction as certain.', 'Catastrophizing', 'Mind Reading'],
                'model_fact' => 'It\'s been seven days since my interview, and I haven\'t received an update.',
                'model_story' => 'I wasn\'t selected for the role.',
                'model_action' => 'Send a polite follow-up email to check status. Continue applying for other opportunities.',
                'model_principle' => 'A delayed response is not the same as a negative response.',
                'closing_reflection' => 'Where else have I mistaken uncertainty for certainty?'
            ],
            15 => [
                'case_id' => 'P1-015',
                'domain' => 'Parenting',
                'primary_trap' => 'Mind Reading',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Reality Check',
                'mission' => 'Don\'t assume you know the reason.',
                'learning_objective' => 'Test Assumptions with Evidence',
                'opening_scenario' => 'Your teenage son spends more time alone in his room with the door closed and speaks very little at meals. You think: "He doesn\'t want to talk to me anymore."',
                'correct_trap' => 'Mind Reading',
                'trap_options' => ['Mind Reading - Assuming intentions without evidence.', 'Emotional Reasoning', 'Fortune Telling'],
                'model_fact' => 'My son has been spending more time in his room and speaking less than usual.',
                'model_story' => 'He is upset with me and no longer wants to talk to me.',
                'model_action' => 'Ask calmly: "I\'ve noticed you\'ve been spending more time in your room. Is everything okay?"',
                'model_principle' => 'Observing someone\'s behaviour is different from knowing the reason behind it.',
                'closing_reflection' => 'Where else have I assumed someone\'s intention without first asking them?'
            ],
            16 => [
                'case_id' => 'P1-016',
                'domain' => 'Business',
                'primary_trap' => 'Confirmation Bias',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Reframe',
                'mission' => 'Don\'t let one explanation become the only explanation.',
                'learning_objective' => 'Generate Alternative Explanations',
                'opening_scenario' => 'Sales at your small business declined for two months. A friend says: "Customers don\'t like your product anymore." You start noticing only things supporting that conclusion.',
                'correct_trap' => 'Confirmation Bias',
                'trap_options' => ['Confirmation Bias - Only seeing confirming details.', 'Catastrophizing', 'Fortune Telling'],
                'model_fact' => 'Sales have declined for the past two months.',
                'model_story' => 'Customers no longer like my product.',
                'model_action' => 'Review sales data, speak with customers, compare previous months, and identify patterns before changing products.',
                'model_principle' => 'The first explanation that comes to mind isn\'t always the correct one.',
                'closing_reflection' => 'Where else have I accepted one explanation without looking for alternatives?'
            ],
            17 => [
                'case_id' => 'P1-017',
                'domain' => 'Negotiation',
                'primary_trap' => 'Sunk Cost Fallacy',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Intervention',
                'mission' => 'Know when persistence becomes attachment.',
                'learning_objective' => 'Choose Thoughtful Actions',
                'opening_scenario' => 'You\'ve been negotiating a partnership for six weeks. Every meeting adds new conditions. The agreement still doesn\'t meet your goals. You think: "I\'ve invested so much time, I must make it work."',
                'correct_trap' => 'Sunk Cost Fallacy',
                'trap_options' => ['Sunk Cost Fallacy - Continuing because of past investment.', 'Confirmation Bias', 'Validation Seeking'],
                'model_fact' => 'I\'ve spent six weeks negotiating, and terms don\'t meet my expectations.',
                'model_story' => 'I can\'t walk away now because all that effort will be wasted.',
                'model_action' => 'Review terms against original goals. If goals aren\'t met, respectfully end negotiation.',
                'model_principle' => 'Good judgment isn\'t about protecting past effort. It\'s about making the best decision with today\'s facts.',
                'closing_reflection' => 'What am I continuing today mainly because of past investment?'
            ],
            18 => [
                'case_id' => 'P1-018',
                'domain' => 'Workplace',
                'primary_trap' => 'All-or-Nothing Thinking',
                'difficulty' => 'Intermediate',
                'primary_skill' => 'Internalize',
                'mission' => 'One piece of feedback doesn\'t define your ability.',
                'learning_objective' => 'Internalize the Thinking Process',
                'opening_scenario' => 'Your manager says: "Overall, you\'ve been doing good work. I\'d like you to improve your presentation skills." You leave thinking: "I\'m not good at my job."',
                'correct_trap' => 'All-or-Nothing Thinking',
                'trap_options' => ['All-or-Nothing Thinking - Minor gap treated as total failure.', 'Emotional Reasoning', 'Confirmation Bias'],
                'model_fact' => 'My manager appreciated my overall work and suggested improving presentation skills.',
                'model_story' => 'I\'m performing poorly and I\'m not good enough.',
                'model_action' => 'Thank manager and ask for specific suggestions to improve presentation skills as a development plan.',
                'model_principle' => 'One area for improvement does not define my overall ability.',
                'closing_reflection' => 'Where have I allowed one piece of feedback to define my entire ability?'
            ],
            19 => [
                'case_id' => 'P1-019',
                'domain' => 'Career',
                'primary_trap' => 'Mixed Judgment Scenario',
                'difficulty' => 'Intermediate–Advanced',
                'primary_skill' => 'Guided Challenge',
                'mission' => 'Good judgment begins by slowing down before reaching a conclusion.',
                'learning_objective' => 'Apply the complete ThinkClear Framework',
                'opening_scenario' => 'After 4 years at your company, your manager invites you to "Team Meeting – Organizational Update." You see HR meeting privately with managers, and colleagues rumour restructuring. You think: "I\'m probably going to lose my job."',
                'correct_trap' => 'Mixed Judgment Scenario',
                'trap_options' => ['Fortune Telling', 'Catastrophizing', 'Confirmation Bias'],
                'model_fact' => 'An organizational update meeting is scheduled.',
                'model_story' => 'I\'m going to lose my job.',
                'model_action' => 'Continue performing responsibilities professionally. Attend meeting with an open mind.',
                'model_principle' => 'When uncertainty increases, good judgment becomes even more important. My first thought isn\'t always my best thought.',
                'closing_reflection' => 'Which part of today\'s situation was fact, and which part came from your own interpretation?'
            ],
            20 => [
                'case_id' => 'P1-020',
                'domain' => 'Workplace',
                'primary_trap' => 'Independent Checkpoint',
                'difficulty' => 'Checkpoint (Advanced)',
                'primary_skill' => 'Internalize (Independent Application)',
                'mission' => 'Trust the process you\'ve been practising.',
                'learning_objective' => 'Apply the complete ThinkClear Framework independently.',
                'opening_scenario' => 'You receive an email: "Please see me before you leave today." Manager is busy in meetings. A colleague asks if you got that email too. By lunchtime, you wonder if something is wrong.',
                'correct_trap' => 'No single correct answer - Independent Checkpoint',
                'trap_options' => ['Fortune Telling', 'Mind Reading', 'Catastrophizing'],
                'model_fact' => 'My manager asked to see me before I leave today without details.',
                'model_story' => 'Something is wrong with my job.',
                'model_action' => 'Attend the meeting with an open mind. Avoid drawing conclusions before hearing from your manager.',
                'model_principle' => 'Congratulations on completing Phase 1! You can now run the 6-step framework independently.',
                'closing_reflection' => 'Congratulations. Twenty days ago, ThinkClear guided you. Today, you completed the framework on your own. You\'re ready for Phase 2.'
            ],
        ];

        $curriculum = $data[$day];

        return [
            'day_number' => $day,
            'case_id' => $curriculum['case_id'],
            'domain' => $curriculum['domain'],
            'primary_trap' => $curriculum['primary_trap'],
            'secondary_trap' => null,
            'difficulty' => $curriculum['difficulty'],
            'primary_skill' => $curriculum['primary_skill'],
            'mission' => $curriculum['mission'],
            'learning_objective' => $curriculum['learning_objective'],
            'phase_target' => 1,
            'trap_target' => [$curriculum['primary_trap']],
            'opening_scenario' => $curriculum['opening_scenario'],
            'step1_detect' => [
                'fact_prompt' => 'Write only the facts.',
                'story_prompt' => 'Now write the story your mind is creating.',
                'insight' => 'Separate facts from story.',
                'model_fact' => $curriculum['model_fact'],
                'model_story' => $curriculum['model_story'],
            ],
            'step2_decode' => [
                'options' => $curriculum['trap_options'],
                'correct_trap' => $curriculum['correct_trap'],
                'explanation' => 'Identify the active cognitive bias.'
            ],
            'step3_reality_check' => [
                'q1' => 'What fact do you know for certain?',
                'q2' => 'What are you assuming?',
                'q3' => 'What evidence supports your assumption?',
                'q4' => 'What evidence contradicts it?',
                'q5' => 'If someone else described this situation, what would you tell them?',
                'tip' => 'Ask "What happened?" before concluding.'
            ],
            'step4_reframe' => [
                'prompt' => 'Write at least 3 other explanations that also fit the facts.',
                'model_reframe' => ['Alternative explanation 1', 'Alternative explanation 2', 'Alternative explanation 3'],
                'challenge_prompt' => 'Can you think of one more explanation?'
            ],
            'step5_intervention' => [
                'prompt' => 'Based on the evidence available, what is one thoughtful action you can take?',
                'model_action' => $curriculum['model_action'],
                'reminder' => 'Choose one reasonable action based on evidence.'
            ],
            'step6_internalize' => [
                'prompt' => 'Complete this sentence: "Today I learned that..."',
                'model_principle' => $curriculum['model_principle'],
                'closing_reflection' => $curriculum['closing_reflection']
            ],
            'developer_notes' => [
                'primary_skill' => $curriculum['primary_skill'],
                'primary_trap' => $curriculum['primary_trap'],
                'difficulty' => $curriculum['difficulty'],
                'estimated_time' => '3–5 minutes'
            ],
            'is_active' => true,
        ];
    }
}
