# ThinkClear REST API Documentation (v1)

**Base URL**: `http://localhost:8000/api/v1` (or `https://api.thinkclear.co.in/api/v1`)  
**Auth Header**: `Authorization: Bearer <token>`

---

## 1. Curriculum Introductions APIs (Public & Authenticated)

### 1.1 Get All Curriculum Introductions
- **Endpoint**: `GET /api/v1/foundation/introductions`
- **Auth**: None required (publicly accessible) or Bearer token
- **Description**: Returns all introductory copy for the app-front page ("THINKCLEAR Your Judgment Journey"), Phase 1 ("PHASE 1 — FOUNDATION Learn to Think Clearly"), Phase 2 ("PHASE 2 — APPLICATION Use the Process When Things Get Complicated"), and Phase 3 ("PHASE 3 — DECISION FITNESS Build Judgment for Decisions That Matter").

### 1.2 Get Specific Phase Introduction
- **Endpoint**: `GET /api/v1/foundation/phase/{phase_number}/intro`
- **Parameters**: `phase_number` (1, 2, or 3)
- **Auth**: None required or Bearer token
- **Description**: Returns the specific introduction for Phase 1, Phase 2, or Phase 3.

---

## 2. Curriculum Program APIs (`/api/v1/foundation/...`)

### 2.1 Get Day Content (Days 1–40 / Phases 1 & 2)
- **Endpoints**:
  - `GET /api/v1/foundation/days/{day_number}` (General day endpoint for Days 1–60)
  - `GET /api/v1/foundation/phase1/days/{day_number}` (Phase 1: Days 1–20)
  - `GET /api/v1/foundation/phase2/days/{day_number}` (Phase 2: Days 21–40)
- **Auth**: Bearer token required
- **Description**: Returns the full curriculum bundle for the specified day, including domain, mission, learning objective, judgment scenario, 6 framework steps (Detect, Decode, Reality Check, Reframe, Intervention, Internalize), model answers ("ThinkClear's Thinking"), and closing reflection.

### 2.2 Submit Day Responses
- **Endpoints**:
  - `POST /api/v1/foundation/days/{day_number}/responses`
  - `POST /api/v1/foundation/phase1/days/{day_number}/responses`
  - `POST /api/v1/foundation/phase2/days/{day_number}/responses`
- **Auth**: Bearer token required
- **Description**: Submits the user's responses for all 6 steps, updates progress, assigns current phase, and returns decode validation and next day unlocking status. On Day 20, returns Phase 1 milestone walkthrough. On Day 40, returns Phase 2 milestone walkthrough.

**Sample Request Body (Day 21)**:
```json
{
  "responses": {
    "detect.facts": "I have worked here three years with positive reviews. Another colleague was promoted without explanation.",
    "detect.story": "My manager no longer believes in me.",
    "decode.selected_option": "validation_seeking",
    "reality_check.q1": "I wasn't promoted.",
    "reality_check.q2": "Assuming my manager lost confidence in me.",
    "reality_check.q3": "Colleague got promoted instead.",
    "reality_check.q4": "My past performance was consistently appreciated.",
    "reality_check.q5": "What specific criteria were used for the promotion?",
    "reframe.alt_explanations": [
      "Colleague had specific skills needed for that role.",
      "Another opportunity is planned.",
      "Budget or timing constraint.",
      "Other factors I don't know yet."
    ],
    "intervention.action": "Schedule a 1-on-1 with manager to ask for constructive feedback on future growth.",
    "internalize.principle": "Not receiving what I expected doesn't automatically explain why. Good judgment begins when I separate facts from the story my mind creates.",
    "closing.journal": "I will discuss directly with my manager before assuming anything."
  },
  "input_method": "typed"
}
```

### 2.3 Get Saved Responses
- **Endpoints**:
  - `GET /api/v1/foundation/days/{day_number}/responses`
  - `GET /api/v1/foundation/phase1/days/{day_number}/responses`
  - `GET /api/v1/foundation/phase2/days/{day_number}/responses`
- **Auth**: Bearer token required
- **Description**: Returns previously submitted responses for review or resuming.

### 2.4 Get Progress / Unlock State
- **Endpoint**: `GET /api/v1/foundation/progress`
- **Auth**: Bearer token required
- **Description**: Returns overall student progress, unlocked phase (1, 2, or 3), current active day, list of completed days, `phase1_completed`, and `phase2_completed` boolean flags.

---

## 3. The 9 ThinkClear Thinking Traps
All Phase 1 and Phase 2 scenarios draw from the official 9 thinking traps:
1. **Mind Reading**: Assuming others' intentions without evidence.
2. **Fortune Telling**: Treating an unverified prediction as certain.
3. **Emotional Reasoning**: Treating a feeling as proof of reality.
4. **Catastrophizing**: Assuming the absolute worst outcome.
5. **Confirmation Bias**: Only seeing details that confirm the feared story.
6. **Rumination**: Repetitive, circular overthinking of past events.
7. **All-or-Nothing Thinking**: Treating a minor gap as total failure or framing as either-or.
8. **Validation Seeking**: Allowing external approval to define self-worth or decisions.
9. **Sunk Cost Fallacy**: Continuing a path solely because of past unrecoverable investment.
