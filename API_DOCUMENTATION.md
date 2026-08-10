# ThinkClear REST API Documentation (v1)

**Base URL**: `http://localhost:8000/api/v1` (or `https://api.thinkclear.co.in/api/v1`)  
**Auth Header**: `Authorization: Bearer <token>`

---

## 1. Auth Endpoints
- `POST /api/v1/register` — Standard User Registration
- `POST /api/v1/login` — Email & Password Login
- `POST /api/v1/social-login` — Google & Apple OAuth Login
- `POST /api/v1/forgot-password` — Request 6-digit OTP
- `POST /api/v1/reset-password` — Verify OTP & Reset Password
- `GET /api/v1/user/profile` — Get User Profile Details
- `POST /api/v1/logout` — Revoke Bearer Token

---

## 2. Foundation Program Phase 1 APIs (`/api/v1/foundation/...`)

### 2.1 Get Day Content
- **Endpoint**: `GET /api/v1/foundation/phase1/days/{day_number}`
- **Auth**: Bearer token required
- **Description**: Returns the full curriculum content bundle for a specific day (Days 1–20), including title, domain, mission, learning objective, scenario text, 6 framework steps (Detect, Decode, Reality Check, Reframe, Intervention, Internalize), prompts, reference examples, and closing reflection.

**Example 200 OK Response (Day 1)**:
```json
{
  "day": 1,
  "phase": 1,
  "title": "Read but No Reply",
  "domain": "Relationships",
  "mission": "Don't let your mind write the story before the facts.",
  "learning_objective": "Separate Facts from Stories",
  "difficulty": "Beginner",
  "emotional_intensity": "Low",
  "estimated_minutes": "3-5",
  "primary_skill": "Detect",
  "primary_trap": "Mind Reading",
  "secondary_trap": null,
  "scenario_text": "Ananya sends her husband a message during lunch asking him to call when he is free.\nHe reads the message.\nThree hours pass.\nThere is still no reply.",
  "steps": [ ... ],
  "closing_reflection": { ... }
}
```

---

### 2.2 Submit Day Responses
- **Endpoint**: `POST /api/v1/foundation/phase1/days/{day_number}/responses`
- **Auth**: Bearer token required
- **Description**: Submits student responses for all 6 steps and closing reflection. Updates progress, unlocks the next day, and returns decode validation results (or the end-of-day walkthrough for Day 20).

**Request Body**:
```json
{
  "responses": {
    "detect.facts": "He read my message three hours ago and hasn't replied.",
    "detect.story": "He's upset with me and ignoring me.",
    "decode.selected_option": "mind_reading",
    "reality_check.q1": "He read the message three hours ago.",
    "reality_check.q2": "That he's upset with me.",
    "reality_check.q3": "He hasn't replied yet.",
    "reality_check.q4": "He often replies late when busy at work.",
    "reality_check.q5": "I'd tell them to wait before assuming the worst.",
    "reframe.alt_explanations": [
      "He got busy at work.",
      "His phone died.",
      "He's driving."
    ],
    "reframe.one_more_explanation": "He's in a meeting and can't check his phone.",
    "intervention.action": "Wait until end of day, then send one calm follow-up message.",
    "internalize.principle": "A delayed reply is a fact, not a betrayal.",
    "closing.journal": "I do this with my sister too — I'll notice it next time."
  },
  "input_method": "typed",
  "started_at": "2026-08-10T09:00:00Z",
  "completed_at": "2026-08-10T09:05:00Z"
}
```

**Response (Days 1–19)**:
```json
{
  "day": 1,
  "status": "completed",
  "decode_result": {
    "selected_option": "mind_reading",
    "is_correct": true,
    "explanation": "Why Mind Reading. The only confirmed fact is that there has been no reply..."
  },
  "unlocked_next_day": 2
}
```

**Response (Day 20 Checkpoint)**:
```json
{
  "day": 20,
  "status": "completed",
  "end_of_day_walkthrough": {
    "facts": [ ... ],
    "traps_present": [ "Fortune Telling", "Mind Reading", "Catastrophizing" ],
    "alternative_explanations": [ ... ],
    "one_reasonable_action": [ ... ]
  },
  "unlocked_next_day": 21
}
```

---

### 2.3 Get Saved Responses
- **Endpoint**: `GET /api/v1/foundation/phase1/days/{day_number}/responses`
- **Auth**: Bearer token required
- **Description**: Returns the user's saved responses for a day (enables resuming in-progress days or reviewing past completed days for Day 60 growth comparison).

**Response 200 OK**:
```json
{
  "day": 1,
  "status": "completed",
  "responses": { ... },
  "input_method": "typed",
  "started_at": "2026-08-10T09:00:00Z",
  "completed_at": "2026-08-10T09:05:00Z"
}
```

---

### 2.4 Get Progress / Unlock State
- **Endpoint**: `GET /api/v1/foundation/progress`
- **Auth**: Bearer token required
- **Description**: Returns the overall progress state, completed day numbers, current phase, current day, and Day 0 completion status.

**Response 200 OK**:
```json
{
  "day0_completed": true,
  "current_phase": 1,
  "current_day": 6,
  "completed_days": [ 1, 2, 3, 4, 5 ],
  "phase1_completed": false
}
```
