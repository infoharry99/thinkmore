-- ==============================================================================
-- ThinkClear Application - Phase 1 Complete Curriculum SQL Seed (Days 1 to 20)
-- Somaru Healthcare LLP
-- Database: bookmyre_thinkclear
-- Compatible with phpMyAdmin / MySQL 5.7+ / MySQL 8.0+
-- ==============================================================================

USE `bookmyre_thinkclear`;

-- Clear existing Phase 1 cases (IDs 1 to 20) before inserting
DELETE FROM `cases` WHERE `day_number` BETWEEN 1 AND 20;

-- ------------------------------------------------------------------------------
-- DAY 1: Read but No Reply (Relationships • Mind Reading)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(1, 1, 'P1-001', 'Relationships', 'Mind Reading', 'Beginner', 'Detect', 
'Don\'t let your mind write the story before the facts.', 
'Separate Facts from Stories', 1, '["Mind Reading"]',
'Ananya sends her husband a message during lunch asking him to call when he is free. He reads the message. Three hours pass. There is still no reply.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story/assumptions your mind is creating.", "insight": "Your brain creates stories automatically. Your first responsibility is to separate them from facts.", "model_fact": "He read my message three hours ago and hasn\'t replied.", "model_story": "He is upset with me and is ignoring me."}',
'{"options": ["Catastrophizing - Assuming the absolute worst outcome.", "Mind Reading - Assuming others\' intentions without evidence.", "Emotional Reasoning - Treating a feeling as proof of reality."], "correct_trap": "Mind Reading", "explanation": "The only confirmed fact is that there has been no reply. The story is that he is upset and deliberately ignoring her. There is no evidence to support that conclusion."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask What happened? before asking How are you feeling?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["He got busy at work.", "He planned to reply later and forgot.", "He is driving.", "His phone battery died."], "challenge_prompt": "Can you think of one more explanation that also fits the facts?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Wait until the end of the workday. If there is still no reply, send one calm message: Just checking if everything is okay. Call me when you are free.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "A delayed reply is a fact. Being ignored is a story/assumptions until evidence proves otherwise."}',
'Where else in my life might I be confusing facts with stories?', 1);

-- ------------------------------------------------------------------------------
-- DAY 2: Let\'s Meet Tomorrow (Workplace • Fortune Telling)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(2, 2, 'P1-002', 'Workplace', 'Fortune Telling', 'Beginner', 'Decode',
'Don\'t predict the future without evidence.',
'Recognize Thinking Traps', 1, '["Fortune Telling"]',
'At 8:15 PM, your manager sends you a message: "Let\'s meet tomorrow morning." There is no agenda. No explanation. No follow-up message. You spend the rest of the evening wondering what the meeting is about.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Your mind naturally tries to predict what happens next. Predictions are not facts.", "model_fact": "My manager asked to meet me tomorrow morning.", "model_story": "I\'m probably in trouble or about to receive negative feedback."}',
'{"options": ["Fortune Telling - Treating an unverified prediction as certain.", "Mind Reading - Assuming others\' intentions without evidence.", "Catastrophizing - Assuming the absolute worst outcome."], "correct_trap": "Fortune Telling", "explanation": "Nothing has happened yet. Your mind has filled in the missing information by predicting an outcome without evidence."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask What happened? before asking How are you feeling?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The manager wants to discuss a new project.", "The meeting is part of a routine review.", "The manager needs your input on an upcoming task.", "The manager prefers discussing something in person."], "challenge_prompt": "Can you think of one positive possibility that also fits the facts?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Avoid jumping to conclusions. Prepare for the meeting as you normally would and wait until you have more information before interpreting the situation.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "An uncertain future is not evidence. Predictions should never be treated as facts."}',
'Where else today might I be predicting an outcome without enough evidence?', 1);

-- ------------------------------------------------------------------------------
-- DAY 3: The Different Tone (Family • Emotional Reasoning)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(3, 3, 'P1-003', 'Family', 'Emotional Reasoning', 'Beginner', 'Reality Check',
'Feelings are real. Conclusions need evidence.',
'Test Assumptions with Evidence', 1, '["Emotional Reasoning"]',
'During dinner, your father answers your question with just one word. He doesn\'t smile. He quietly continues eating. The rest of the family continues talking normally. You suddenly feel that he is upset with you.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Your feelings may be genuine. But feelings are not evidence. Always separate what happened from what you believe it means.", "model_fact": "My father answered briefly during dinner and didn\'t smile.", "model_story": "He must be angry with me."}',
'{"options": ["Mind Reading - Assuming others\' intentions without evidence.", "Emotional Reasoning - Treating a feeling as proof of reality.", "Catastrophizing - Assuming the absolute worst outcome."], "correct_trap": "Emotional Reasoning", "explanation": "Feeling worried doesn\'t automatically mean something is wrong. The feeling is real. The conclusion still needs evidence."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask What happened? before asking How are you feeling?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["He had a tiring day.", "He is thinking about something unrelated.", "He isn\'t feeling physically well.", "He simply isn\'t in the mood to talk much today."], "challenge_prompt": "Can you think of one explanation that has nothing to do with you?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Rather than assuming something is wrong, wait for an appropriate moment and calmly ask: You seemed quieter than usual today. Is everything okay? Then listen without assuming the answer.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Feeling worried doesn\'t prove that something is wrong. Feelings deserve attention, but conclusions require evidence."}',
'Where else in my life have I mistaken a feeling for a fact?', 1);

-- ------------------------------------------------------------------------------
-- DAY 4: The Internet Diagnosis (Health • Catastrophizing)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(4, 4, 'P1-004', 'Health', 'Catastrophizing', 'Beginner', 'Reframe',
'One possibility is not the only possibility.',
'Generate Alternative Explanations', 1, '["Catastrophizing"]',
'You notice a small lump on your neck. It isn\'t painful. You search your symptoms online. By the time you stop reading, you\'re convinced something is seriously wrong.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "When information is incomplete, your brain often fills the gaps with the worst possible explanation. That doesn\'t make it true.", "model_fact": "I noticed a small lump on my neck and searched for it online.", "model_story": "I probably have a serious illness."}',
'{"options": ["Catastrophizing - Assuming the absolute worst outcome.", "Fortune Telling - Treating an unverified prediction as certain.", "Confirmation Bias - Only seeing details that confirm the feared story."], "correct_trap": "Catastrophizing", "explanation": "Finding one possible explanation online doesn\'t mean it is the correct explanation. Your mind has immediately jumped to the worst-case scenario without sufficient evidence."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask What happened? before asking What could happen?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["It could be a swollen lymph node caused by a minor infection.", "It could be a harmless cyst.", "It could be temporary and disappear in a few days.", "A healthcare professional can assess it properly."], "challenge_prompt": "Can you think of one explanation that is less serious than your first thought?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Instead of assuming the worst, make an appointment with a qualified healthcare professional and avoid drawing conclusions based only on internet searches.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "The worst possible explanation is only one possibility—not a conclusion."}',
'Where else in my life have I assumed the worst before gathering enough evidence?', 1);

-- ------------------------------------------------------------------------------
-- DAY 5: The Promotion Announcement (Career • Confirmation Bias)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(5, 5, 'P1-005', 'Career', 'Confirmation Bias', 'Beginner', 'Intervention',
'Don\'t look only for evidence that supports your belief.',
'Choose Thoughtful Actions', 1, '["Confirmation Bias"]',
'Your manager announces that a colleague has been promoted. You had also applied for the same position. As the day goes on, you begin replaying past conversations with your manager. You start remembering only the moments that make you feel you were overlooked.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Once your brain believes a story, it naturally starts collecting evidence to support it. That doesn\'t mean the story is true.", "model_fact": "A colleague received the promotion.", "model_story": "My manager doesn\'t value my work and passed me over unfairly."}',
'{"options": ["Mind Reading - Assuming others\' intentions without evidence.", "Confirmation Bias - Only seeing details that confirm the feared story.", "All-or-Nothing Thinking - Treating a minor gap as total failure."], "correct_trap": "Confirmation Bias", "explanation": "Instead of considering all the available information, your mind has started collecting only the memories that support your belief that you were unfairly treated."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence might contradict your assumption?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask yourself, What evidence am I ignoring? before deciding you are right."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The promoted colleague may have had additional experience.", "The decision may have been based on skills needed for that specific role.", "Your manager may value your work but believe you need more experience.", "There may have been selection criteria you were unaware of."], "challenge_prompt": "Can you think of one explanation that doesn\'t support your current belief?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Instead of assuming the reason, schedule a meeting with your manager and ask for constructive feedback. Focus on understanding what skills would strengthen your chances in the future.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Looking for evidence that supports my belief is easy. Looking for evidence that challenges it requires judgment."}',
'Where else in my life might I be noticing only the evidence that supports what I already believe?', 1);

-- ------------------------------------------------------------------------------
-- DAY 6: The School Complaint (Parenting • Rumination)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(6, 6, 'P1-006', 'Parenting', 'Rumination', 'Beginner', 'Internalize',
'Learn from the situation. Don\'t live inside it.',
'Internalize the Thinking Process', 1, '["Rumination"]',
'Your child comes home with a note from school. It says they were talking during class despite repeated warnings. That evening, you keep replaying the incident in your mind. You begin wondering if you\'re a bad parent and whether your child is developing behavioural problems.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "One event can stay in your mind long after it has happened. Thinking about it repeatedly doesn\'t always lead to better understanding.", "model_fact": "The school informed me that my child was talking during class after repeated warnings.", "model_story": "I\'m failing as a parent, and my child is becoming difficult to manage."}',
'{"options": ["Rumination - Repetitive, circular overthinking of past events.", "Catastrophizing - Assuming the absolute worst outcome.", "All-or-Nothing Thinking - Treating a minor gap as total failure."], "correct_trap": "Rumination", "explanation": "Your mind keeps replaying the same event without discovering new information or moving towards a solution. Thinking more isn\'t always thinking better."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask yourself, Am I solving the problem, or simply replaying it?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["Children sometimes test boundaries at school.", "One incident doesn\'t describe my child\'s overall behaviour.", "The teacher may be informing me early so we can work together.", "This could be an opportunity to understand what happened before reacting."], "challenge_prompt": "Can you think of one explanation that doesn\'t blame you or your child?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Speak calmly with your child to understand what happened. If needed, discuss the situation with the teacher before drawing conclusions.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Replaying the same event doesn\'t always produce new answers. Judgment improves when I move from overthinking to understanding."}',
'What situation have I been replaying without gaining any new understanding?', 1);

-- ------------------------------------------------------------------------------
-- DAY 7: The Silent Client (Business • Mind Reading)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(7, 7, 'P1-007', 'Business', 'Mind Reading', 'Beginner–Intermediate', 'Detect',
'Separate observations from interpretations.',
'Separate Facts from Stories', 1, '["Mind Reading"]',
'You sent a business proposal to an important client. They usually respond within one or two days. Four days have passed. They have viewed your message but haven\'t replied. You begin wondering whether you\'ve lost the client.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "When information is missing, your brain often creates a story to fill the gap. The story may feel convincing, but it still needs evidence.", "model_fact": "The client viewed my proposal four days ago and hasn\'t replied.", "model_story": "The client didn\'t like my proposal and has decided not to work with me."}',
'{"options": ["Mind Reading - Assuming others\' intentions without evidence.", "Fortune Telling - Treating an unverified prediction as certain.", "Confirmation Bias - Only seeing details that confirm the feared story."], "correct_trap": "Mind Reading", "explanation": "The only confirmed fact is that the client hasn\'t replied. Everything else is an interpretation. Without evidence, assuming the client\'s intentions can lead to unnecessary stress or poor decisions."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask yourself, What do I know? before asking, What does it mean?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The client is reviewing the proposal internally.", "They are waiting for approval from another decision-maker.", "They became busy with other priorities.", "They intend to reply but haven\'t had the opportunity yet."], "challenge_prompt": "Can you think of one explanation that has nothing to do with the quality of your proposal?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Send a polite follow-up message after a reasonable interval: Hello, just checking whether you have had a chance to review the proposal. Please let me know if you have any questions.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Silence is a fact. The meaning I attach to that silence is a story until evidence proves otherwise."}',
'Where else today have I assumed someone\'s intention without actually knowing it?', 1);

-- ------------------------------------------------------------------------------
-- DAY 8: The First Offer (Finance • Validation Seeking)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(8, 8, 'P1-008', 'Finance', 'Validation Seeking', 'Beginner–Intermediate', 'Decode',
'Don\'t let someone else\'s opinion become your only measure of your worth.',
'Recognize Thinking Traps', 1, '["Validation Seeking"]',
'After several interview rounds, you finally receive a job offer. The salary offered is lower than you expected. Before reviewing the complete role or responsibilities, you immediately begin wondering: Maybe this is all I\'m worth.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "One person\'s opinion or one offer doesn\'t define your value. It is only one piece of information.", "model_fact": "I received a job offer with a lower salary than I expected.", "model_story": "The company thinks I\'m not valuable enough."}',
'{"options": ["Validation Seeking - Heavy reliance on immediate external acknowledgment.", "All-or-Nothing Thinking - Treating a minor gap as total failure.", "Confirmation Bias - Only seeing details that confirm the feared story."], "correct_trap": "Validation Seeking", "explanation": "Instead of viewing the offer as one negotiation point, your mind has started using it as proof of your personal worth. External feedback is information—it isn\'t your identity."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Feedback informs you. It doesn\'t define you."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The company may have salary bands for the role.", "The offer may simply be their opening position.", "There may be room for negotiation.", "Budget constraints may influence the offer."], "challenge_prompt": "Can you think of one explanation that has nothing to do with your abilities?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Review the complete offer objectively, research market salaries, and negotiate respectfully based on your experience and value.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "External feedback provides information. It does not determine my worth."}',
'Where else have I allowed someone else\'s opinion to define how I see myself?', 1);

-- ------------------------------------------------------------------------------
-- DAY 9: Left Out of the Meeting (Workplace • Confirmation Bias)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(9, 9, 'P1-009', 'Workplace', 'Confirmation Bias', 'Intermediate', 'Reality Check',
'Verify before you conclude.',
'Test Assumptions with Evidence', 1, '["Confirmation Bias"]',
'You arrive at work and notice that several colleagues are discussing a meeting that happened yesterday. You weren\'t invited. No one has spoken to you about it. You immediately begin wondering whether you are being excluded from important decisions.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "When information is incomplete, your brain quickly tries to explain why. An explanation isn\'t the same as evidence.", "model_fact": "A meeting took place yesterday, and I wasn\'t present.", "model_story": "I\'m being excluded because my manager no longer values my contribution."}',
'{"options": ["Confirmation Bias - Only seeing details that confirm the feared story.", "Mind Reading - Assuming others\' intentions without evidence.", "Fortune Telling - Treating an unverified prediction as certain."], "correct_trap": "Confirmation Bias", "explanation": "Once you believe you\'re being excluded, your mind starts looking for evidence that supports that belief. At the same time, it ignores other possible explanations."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "What information is still missing before you can reach a conclusion?", "tip": "Missing information is not evidence. Gather facts before filling the gaps."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The meeting involved a project you aren\'t currently assigned to.", "It was arranged at short notice.", "Someone assumed another colleague had already informed you.", "A follow-up discussion may still be planned."], "challenge_prompt": "Can you think of one explanation that doesn\'t involve anyone intentionally excluding you?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Rather than assuming the reason, ask your manager: I heard there was a meeting yesterday. Could you help me understand what it was about and whether there is anything I should know?", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "When information is missing, my first responsibility is to gather facts—not create explanations."}',
'Where else have I filled gaps in information with my own explanation instead of asking for facts?', 1);

-- ------------------------------------------------------------------------------
-- DAY 10: Cancelled Dinner (Relationships • Fortune Telling)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(10, 10, 'P1-010', 'Relationships', 'Fortune Telling', 'Intermediate', 'Reframe',
'One event can have many explanations.',
'Generate Alternative Explanations', 1, '["Fortune Telling"]',
'You and your partner planned to have dinner together after work. An hour before meeting, they send a message: "I\'m really sorry. Can we do this another day?" No explanation is given. You immediately begin thinking that something is wrong with the relationship.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "A cancelled plan is a fact. The meaning you attach to it is an interpretation.", "model_fact": "My partner cancelled our dinner plans and asked to meet another day.", "model_story": "Our relationship is changing, and they don\'t want to spend time with me anymore."}',
'{"options": ["Fortune Telling - Treating an unverified prediction as certain.", "Mind Reading - Assuming others\' intentions without evidence.", "Catastrophizing - Assuming the absolute worst outcome."], "correct_trap": "Fortune Telling", "explanation": "Your mind has taken one cancelled plan and predicted what it believes will happen next. Nothing in the situation confirms that prediction."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If this happened to a close friend, what advice would you give them?", "tip": "Don\'t confuse today\'s event with tomorrow\'s prediction."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["Something urgent came up at work.", "They aren\'t feeling well.", "A family responsibility unexpectedly arose.", "They genuinely want to meet another day when they can give full attention."], "challenge_prompt": "Can you think of one explanation that assumes good intent instead of bad intent?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Reply calmly and acknowledge the change of plans: No problem. Let me know when you are free, and we will plan another day.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "One cancelled plan does not predict the future of a relationship."}',
'Where else have I treated one event as proof of what will happen next?', 1);

-- ------------------------------------------------------------------------------
-- DAY 11: Should I Continue? (Career • Sunk Cost Fallacy)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(11, 11, 'P1-011', 'Career', 'Sunk Cost Fallacy', 'Intermediate', 'Intervention',
'Past investment should not decide future decisions.',
'Choose Thoughtful Actions', 1, '["Sunk Cost Fallacy"]',
'Six months ago, you enrolled in a professional certification course. You\'ve attended only a few sessions. You no longer enjoy the course and don\'t see yourself using the qualification. However, every time you think about stopping, you remind yourself how much time and money you\'ve already invested.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Past investments cannot be recovered. Good judgment is about deciding what makes the most sense from today onward.", "model_fact": "I enrolled in the course six months ago and no longer enjoy it.", "model_story": "Stopping now means I wasted my time and money."}',
'{"options": ["Sunk Cost Fallacy - Continuing a course of action because of past investment.", "Confirmation Bias - Only seeing details that confirm the feared story.", "Rumination - Repetitive overthinking of past events."], "correct_trap": "Sunk Cost Fallacy", "explanation": "The decision is being influenced by what you\'ve already invested rather than by whether continuing still makes sense."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "If you had not already invested the time and money, would you still choose this course today?", "q4": "What evidence suggests continuing is the best option?", "q5": "What evidence suggests changing direction might be reasonable?", "tip": "Ask yourself, Am I deciding based on the future or trying to justify the past?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The knowledge I\'ve gained still has value.", "Stopping now doesn\'t erase what I\'ve learned.", "My interests and goals may have changed.", "It\'s reasonable to redirect my time toward something fitting my future."], "challenge_prompt": "Can you think of one benefit of changing direction instead of continuing automatically?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Review your current career goals. Make a deliberate decision rather than continuing only because of time and money already invested.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Past investment deserves respect, but future decisions should be guided by future value."}',
'What decision in my life am I continuing mainly because of what I\'ve already invested?', 1);

-- ------------------------------------------------------------------------------
-- DAY 12: The Forgotten Birthday (Family • All-or-Nothing Thinking)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(12, 12, 'P1-012', 'Family', 'All-or-Nothing Thinking', 'Intermediate', 'Internalize',
'One mistake doesn\'t define the whole story.',
'Internalize the Thinking Process', 1, '["All-or-Nothing Thinking"]',
'Your brother forgets your birthday. He doesn\'t call. He doesn\'t send a message. By the end of the day, you begin thinking: He doesn\'t care about me anymore.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "One event may be disappointing. That doesn\'t automatically describe the entire relationship.", "model_fact": "My brother didn\'t wish me on my birthday.", "model_story": "He doesn\'t care about me anymore."}',
'{"options": ["All-or-Nothing Thinking - Treating a minor gap as total failure.", "Mind Reading - Assuming others\' intentions without evidence.", "Emotional Reasoning - Treating a feeling as proof of reality."], "correct_trap": "All-or-Nothing Thinking", "explanation": "Your mind has taken one disappointing event and used it to make a sweeping conclusion about the entire relationship."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "Does this one event represent the entire relationship?", "q4": "What evidence suggests your relationship has been positive at other times?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Don\'t let one moment define the whole relationship."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["He genuinely forgot the date.", "He has been unusually busy.", "Something unexpected may have happened that day.", "He may realize later and apologize."], "challenge_prompt": "Can you think of one memory that contradicts your current conclusion?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Rather than assuming the relationship has changed, speak with your brother when the opportunity arises: I missed hearing from you on my birthday. I just wanted to check if everything is okay.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "One disappointing moment does not define an entire relationship. Judgment requires seeing the bigger picture."}',
'Where else have I allowed one event to shape my opinion of an entire person or situation?', 1);

-- ------------------------------------------------------------------------------
-- DAY 13: Waiting for the Test Report (Health • Emotional Reasoning)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(13, 13, 'P1-013', 'Health', 'Emotional Reasoning', 'Intermediate', 'Detect',
'A feeling is a signal, not a conclusion.',
'Separate Facts from Stories', 1, '["Emotional Reasoning"]',
'Your doctor advises you to undergo a routine blood test. The report will be available in two days. On your way home, you begin feeling anxious. By evening, you find yourself thinking: If I\'m this worried, something must be seriously wrong.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Your emotions provide information about how you feel. They do not provide evidence about what is true.", "model_fact": "My doctor advised a blood test, and the report will be ready in two days.", "model_story": "Because I feel anxious, the report will probably show something serious."}',
'{"options": ["Emotional Reasoning - Treating a feeling as proof of reality.", "Catastrophizing - Assuming the absolute worst outcome.", "Fortune Telling - Treating an unverified prediction as certain."], "correct_trap": "Emotional Reasoning", "explanation": "Feeling anxious while waiting is understandable. The mistake happens when anxiety becomes proof that something bad has happened."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you feeling right now?", "q3": "Are your feelings the same as evidence?", "q4": "What evidence do you actually have today?", "q5": "What information are you still waiting for?", "tip": "Feeling uncertain is normal. Treating uncertainty as evidence is the trap."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["Routine blood tests are commonly recommended.", "The doctor may simply be gathering more information.", "Most test results do not indicate serious illness.", "Waiting for results naturally creates uncertainty."], "challenge_prompt": "Can you think of one explanation that is based on facts rather than feelings?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Wait for the test results before reaching any conclusions. Continue your normal plans in the meantime—a feeling is not a result.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Feeling anxious doesn\'t tell me what the result will be. Feelings deserve attention, but evidence deserves my decisions."}',
'When was the last time I treated a feeling as if it were evidence?', 1);

-- ------------------------------------------------------------------------------
-- DAY 14: No Interview Feedback (Career • Fortune Telling)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(14, 14, 'P1-014', 'Career', 'Fortune Telling', 'Intermediate', 'Decode',
'Predictions are not evidence.',
'Recognize Thinking Traps', 1, '["Fortune Telling"]',
'You attend a job interview that goes well. The interviewer tells you they\'ll get back to you within five working days. Seven days pass. You haven\'t received any email or phone call. You begin thinking: I didn\'t get the job.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "When answers are delayed, your mind often creates one. A prediction may feel convincing, but it isn\'t evidence.", "model_fact": "It\'s been seven days since my interview, and I haven\'t received any update.", "model_story": "I wasn\'t selected for the role."}',
'{"options": ["Fortune Telling - Treating an unverified prediction as certain.", "Catastrophizing - Assuming the absolute worst outcome.", "Mind Reading - Assuming others\' intentions without evidence."], "correct_trap": "Fortune Telling", "explanation": "No decision has been communicated. Your mind has filled the silence with a prediction and accepted it as fact."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "What other explanations could account for the delay?", "tip": "A delay is information. It is not a decision."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The hiring team is interviewing other candidates.", "The hiring manager is unavailable.", "Internal approvals are taking longer than expected.", "The recruitment process has been delayed."], "challenge_prompt": "Can you think of one explanation that has nothing to do with your interview performance?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Wait a reasonable amount of time and send a polite follow-up email. Continue applying for other opportunities.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "A delayed response is not the same as a negative response. Predictions should never replace evidence."}',
'Where else have I mistaken uncertainty for certainty?', 1);

-- ------------------------------------------------------------------------------
-- DAY 15: The Closed Door (Parenting • Mind Reading)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(15, 15, 'P1-015', 'Parenting', 'Mind Reading', 'Intermediate', 'Reality Check',
'Don\'t assume you know the reason.',
'Test Assumptions with Evidence', 1, '["Mind Reading"]',
'Over the past week, your teenage son has been spending more time alone in his room. He closes the door after returning from school. He joins the family for meals but speaks very little. You begin thinking: He doesn\'t want to talk to me anymore.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "A behaviour is something you observe. The reason behind that behaviour is often a story your mind creates.", "model_fact": "My son has been spending more time in his room and speaking less than usual.", "model_story": "He is upset with me and no longer wants to talk to me."}',
'{"options": ["Mind Reading - Assuming others\' intentions without evidence.", "Emotional Reasoning - Treating a feeling as proof of reality.", "Fortune Telling - Treating an unverified prediction as certain."], "correct_trap": "Mind Reading", "explanation": "The behaviour is visible. The intention behind the behaviour is unknown. Without evidence, assuming you know what someone else is thinking leads to misunderstandings."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "Have you asked your child what is happening, or are you assuming you already know?", "tip": "Understanding begins with curiosity, not assumptions."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["He may be tired after school.", "He may be dealing with academic pressure.", "He may simply want some personal space.", "Something at school may be bothering him."], "challenge_prompt": "Can you think of one explanation that has nothing to do with your relationship?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Choose a calm moment to talk: I\'ve noticed you\'ve been spending more time in your room lately. Is everything okay? Listen first. Interpret later.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Observing someone\'s behaviour is different from knowing the reason behind it. Understanding begins by asking, not assuming."}',
'Where else in my life have I assumed someone\'s intention without first asking them?', 1);

-- ------------------------------------------------------------------------------
-- DAY 16: Falling Sales (Business • Confirmation Bias)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(16, 16, 'P1-016', 'Business', 'Confirmation Bias', 'Intermediate', 'Reframe',
'Don\'t let one explanation become the only explanation.',
'Generate Alternative Explanations', 1, '["Confirmation Bias"]',
'You own a small business. Sales have declined for the past two months. A friend tells you: Customers don\'t like your product anymore. For the rest of the day, you begin noticing only things that seem to support that conclusion.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "When your mind accepts one explanation, it naturally starts searching for evidence that supports it. That doesn\'t mean it\'s the correct explanation.", "model_fact": "Sales have declined for the past two months.", "model_story": "Customers no longer like my product."}',
'{"options": ["Confirmation Bias - Only seeing details that confirm the feared story.", "Catastrophizing - Assuming the absolute worst outcome.", "Fortune Telling - Treating an unverified prediction as certain."], "correct_trap": "Confirmation Bias", "explanation": "Once you accepted the idea that customers no longer liked your product, your attention shifted toward information supporting that belief, ignoring alternative explanations."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence challenges your assumption?", "q5": "What information do you still need before deciding why sales have fallen?", "tip": "Strong judgments are built on complete evidence—not selective evidence."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["Demand may be lower because of seasonal changes.", "A new competitor may have entered the market.", "Customers may not know about recent improvements.", "Marketing activity may have decreased."], "challenge_prompt": "Can you think of one explanation that has nothing to do with the quality of your product?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Instead of immediately changing the product, gather more information. Review sales data, speak with customers, and compare previous months.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "The first explanation that comes to mind isn\'t always the correct one. Good judgment requires looking for evidence that both supports and challenges my conclusion."}',
'Where else in my life have I accepted one explanation without looking for alternatives?', 1);

-- ------------------------------------------------------------------------------
-- DAY 17: Walk Away or Continue? (Negotiation • Sunk Cost Fallacy)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(17, 17, 'P1-017', 'Negotiation', 'Sunk Cost Fallacy', 'Intermediate', 'Intervention',
'Know when persistence becomes attachment.',
'Choose Thoughtful Actions', 1, '["Sunk Cost Fallacy"]',
'You\'ve been negotiating a business partnership for the past six weeks. There have been multiple meetings and phone calls. Every discussion ends with new conditions being added. The agreement still doesn\'t meet your original expectations. You begin thinking: I\'ve already invested so much time. I have to make this work.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Time already spent cannot be recovered. The next decision should depend on what creates the most value going forward.", "model_fact": "I\'ve spent six weeks negotiating, and the agreement still doesn\'t meet my expectations.", "model_story": "I can\'t walk away now because all that effort will be wasted."}',
'{"options": ["Sunk Cost Fallacy - Continuing a course of action because of past investment.", "Confirmation Bias - Only seeing details that confirm the feared story.", "Validation Seeking - Heavy reliance on immediate external acknowledgment."], "correct_trap": "Sunk Cost Fallacy", "explanation": "Your decision is becoming driven by the effort you\'ve already invested rather than by whether the partnership still makes sense."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "If these negotiations started today, would you still pursue this opportunity?", "q4": "What benefits still exist if you continue?", "q5": "What risks exist if you continue simply because you\'ve already invested time?", "tip": "Ask yourself, Would I make the same decision if I were starting today?"}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["Walking away may create space for a better opportunity.", "Continuing only makes sense if future benefits justify it.", "Renegotiating the terms may be a better option.", "Time invested is a learning experience, not a reason to continue."], "challenge_prompt": "Can you think of one benefit of saying no instead of continuing?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Review the agreement against your original objectives. If revised terms no longer meet your goals, be prepared to respectfully end negotiation.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Good judgment isn\'t about protecting past effort. It\'s about making the best decision with the information I have today."}',
'What am I continuing today mainly because of what I\'ve already invested, rather than because it still makes sense?', 1);

-- ------------------------------------------------------------------------------
-- DAY 18: Performance Feedback (Workplace • All-or-Nothing Thinking)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(18, 18, 'P1-018', 'Workplace', 'All-or-Nothing Thinking', 'Intermediate', 'Internalize',
'One piece of feedback doesn\'t define your ability.',
'Internalize the Thinking Process', 1, '["All-or-Nothing Thinking"]',
'During your monthly review, your manager says: Overall, you\'ve been doing good work. I\'d like you to improve your presentation skills. You leave the meeting thinking: I\'m not good at my job.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Feedback about one skill is not the same as feedback about your entire ability. Your brain often generalizes from one point to the whole picture.", "model_fact": "My manager appreciated my overall work and suggested improving my presentation skills.", "model_story": "I\'m performing poorly and I\'m not good enough."}',
'{"options": ["All-or-Nothing Thinking - Treating a minor gap as total failure.", "Emotional Reasoning - Treating a feeling as proof of reality.", "Confirmation Bias - Only seeing details that confirm the feared story."], "correct_trap": "All-or-Nothing Thinking", "explanation": "Your manager commented on one area for improvement. Your mind converted that into a judgment about your entire performance."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What positive feedback did you receive?", "q4": "What evidence suggests you are doing well in other areas?", "q5": "Does one improvement area define your overall performance?", "tip": "Growth begins when feedback becomes information instead of identity."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["My manager believes I can improve.", "One development area doesn\'t cancel my strengths.", "Feedback is intended to help me grow.", "Every professional has skills they continue to develop."], "challenge_prompt": "Can you think of one strength your manager has appreciated in the past?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Thank your manager for the feedback. Ask for specific suggestions or opportunities to improve your presentation skills.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "One area for improvement does not define my overall ability. Growth comes from improving the part—not condemning the whole."}',
'Where in my life have I allowed one mistake or one piece of feedback to define my entire ability?', 1);

-- ------------------------------------------------------------------------------
-- DAY 19: The Unexpected Restructure (Career • Mixed Judgment Scenario)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(19, 19, 'P1-019', 'Career', 'Mixed Judgment Scenario', 'Intermediate–Advanced', 'Guided Challenge',
'Good judgment begins by slowing down before reaching a conclusion.',
'Apply the complete ThinkClear Framework', 1, '["Mixed Judgment Scenario"]',
'You\'ve worked in your company for four years. One morning, your manager sends an invitation titled: Team Meeting – Organizational Update. Later that day, you notice HR meeting privately with several managers. Two colleagues mention they\'ve heard there may be restructuring. No official announcement has been made. On your way home, you think: I\'m probably going to lose my job.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Facts are observable. Rumours, predictions and interpretations are not. Always separate what you know from what you think might happen.", "model_fact": "There is an organizational update meeting scheduled.", "model_story": "I\'m going to lose my job because of restructuring."}',
'{"options": ["Fortune Telling - Treating an unverified prediction as certain.", "Catastrophizing - Assuming the absolute worst outcome.", "Confirmation Bias - Only seeing details that confirm the feared story."], "correct_trap": "Mixed Judgment Scenario", "explanation": "There isn\'t just one correct answer. This situation contains multiple thinking traps (Fortune Telling, Catastrophizing, Confirmation Bias). The key is recognizing that your thinking is driving your conclusion."}',
'{"q1": "What facts do you actually know?", "q2": "Which parts of your thinking are assumptions?", "q3": "What evidence supports your conclusion?", "q4": "What evidence challenges it?", "q5": "What information is still missing?", "tip": "Rumours are not evidence. Wait for facts before reaching conclusions."}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["The restructuring may affect reporting lines rather than jobs.", "The meeting may involve expansion rather than downsizing.", "HR may be preparing managers before communicating changes.", "The rumours may be incomplete or inaccurate."], "challenge_prompt": "Can you think of one explanation that you hadn\'t considered at first?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Continue performing your responsibilities professionally. Attend the organizational meeting with an open mind. Wait for official communication before making decisions.", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "When uncertainty increases, good judgment becomes even more important. My first thought isn\'t always my best thought."}',
'Which part of today\'s situation was fact, and which part came from your own interpretation?', 1);

-- ------------------------------------------------------------------------------
-- DAY 20: The Unexpected Email (Workplace • Independent Checkpoint)
-- ------------------------------------------------------------------------------
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(20, 20, 'P1-020', 'Workplace', 'Independent Checkpoint', 'Checkpoint (Advanced)', 'Internalize (Independent Application)',
'Trust the process you\'ve been practising.',
'Apply the complete ThinkClear Framework independently.', 1, '["Independent Checkpoint"]',
'You receive an email from your manager with the subject line: Please see me before you leave today. The email contains no additional details. During the day, you notice your manager is busy in meetings and doesn\'t speak to you. A colleague casually asks: Did you also get that email? By lunchtime, you begin wondering whether something is wrong.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story your mind is creating.", "insight": "Separate observable facts from mental stories.", "model_fact": "My manager asked to see me before I leave today. The email didn\'t explain why.", "model_story": "Something is wrong with my performance or job security."}',
'{"options": ["Fortune Telling", "Mind Reading", "Catastrophizing", "Confirmation Bias", "Rumination", "All-or-Nothing Thinking", "Validation Seeking", "Sunk Cost Fallacy"], "correct_trap": "No single correct answer - Independent Checkpoint", "explanation": "In this independent checkpoint, multiple traps may apply. You are now applying the framework independently."}',
'{"q1": "What facts do you know for certain?", "q2": "What assumptions are you making?", "q3": "What evidence supports those assumptions?", "q4": "What evidence challenges them?", "q5": "What important information is still missing?", "tip": "Apply the 6 steps independently."}',
'{"prompt": "Write at least 4 other explanations that also fit the facts.", "model_reframe": ["The manager wants to discuss an upcoming project.", "It\'s a routine one-to-one meeting.", "The manager needs information before tomorrow.", "Several team members are meeting individually today.", "The meeting has nothing to do with my performance."], "challenge_prompt": "Can you think of one more positive or neutral explanation?"}',
'{"prompt": "Based on the evidence available, what is the most reasonable action?", "model_action": "Attend the meeting with an open mind. Avoid drawing conclusions before hearing what your manager has to say.", "reminder": "Choose one reasonable action based on evidence available."}',
'{"prompt": "Complete this sentence: Today I learned that...", "model_principle": "Today you completed Phase 1 independently! The goal was never to memorize six steps—it was to practise using them until they became natural."}',
'Congratulations. Twenty days ago, ThinkClear guided you. Today, you completed the framework on your own. You are ready for Phase 2.', 1);
