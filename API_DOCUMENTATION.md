# ThinkClear Mobile Application - REST API Specification & Handoff Document

**Document Status**: Production Ready  
**Base URL**: `http://YOUR_SERVER_IP:8000/api/v1` (Local testing: `http://192.168.29.154:8000/api/v1` or `http://localhost:8000/api/v1`)  
**Data Format**: JSON  

---

## 🔑 Common Request Headers

All API requests (except `/register` and `/login`) require the `Authorization` header containing the Sanctum Bearer token received upon authentication.

```http
Content-Type: application/json
Accept: application/json
Authorization: Bearer <YOUR_ACCESS_TOKEN>
```

---

## 1. Authentication Endpoints

### 1.1 User Registration
- **Endpoint**: `POST /register`
- **Authentication**: None (Public)
- **Description**: Registers a new student user and returns a Bearer access token.

#### Request Body
```json
{
  "name": "Arun Mishra",
  "email": "arun@example.com",
  "password": "password123"
}
```

#### Field Specifications
| Parameter | Type | Required | Description |
| :--- | :--- | :--- | :--- |
| `name` | String | Yes | Full name of the user. |
| `email` | String | Yes | Valid unique email address. |
| `password` | String | Yes | Minimum 8 characters. |

#### Success Response (`201 Created`)
```json
{
  "status": "success",
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 2,
      "name": "Arun Mishra",
      "email": "arun@example.com",
      "role": "user",
      "current_day": 1,
      "phase": 0,
      "created_at": "2026-07-23T22:30:00.000000Z",
      "updated_at": "2026-07-23T22:30:00.000000Z"
    },
    "access_token": "1|qX8zK...token_string...",
    "token_type": "Bearer"
  }
}
```

#### Error Response (`422 Unprocessable Content`)
```json
{
  "message": "The email has already been taken.",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}
```

---

### 1.2 User Login
- **Endpoint**: `POST /login`
- **Authentication**: None (Public)
- **Description**: Authenticates an existing user and generates an access token.

#### Request Body
```json
{
  "email": "arun@example.com",
  "password": "password123"
}
```

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Logged in successfully",
  "data": {
    "user": {
      "id": 2,
      "name": "Arun Mishra",
      "email": "arun@example.com",
      "role": "user",
      "current_day": 7,
      "phase": 1
    },
    "access_token": "2|mV9yA...token_string...",
    "token_type": "Bearer"
  }
}
```

---

### 1.3 Get User Profile & Progress
- **Endpoint**: `GET /user/profile`
- **Authentication**: Bearer Token Required

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "data": {
    "user": {
      "id": 2,
      "name": "Arun Mishra",
      "email": "arun@example.com",
      "role": "user",
      "current_day": 7,
      "phase": 1
    },
    "reflections_count": 6,
    "is_foundation_completed": false
  }
}
```

---

### 1.4 User Logout
- **Endpoint**: `POST /logout`
- **Authentication**: Bearer Token Required

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Logged out successfully"
}
```

---

## 2. Daily Case Engine & Reflection Endpoints

### 2.1 Fetch Today's Case Scenario
- **Endpoint**: `GET /cases/today`
- **Authentication**: Bearer Token Required
- **Description**: Returns the active scenario and 6-step framework data for the user's current day and phase.

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "data": {
    "current_day": 7,
    "phase": 1,
    "case": {
      "id": 1,
      "case_id": "P1-001",
      "domain": "Relationships/Family",
      "phase_target": 1,
      "trap_target": [
        "Mind Reading",
        "Emotional Reasoning"
      ],
      "opening_scenario": "Rohan gets home from work, says a quick \"hi,\" goes to the bedroom, and doesn't say much through dinner. His wife, Priya, notices he's been unusually quiet for two hours.",
      "step1_detect": {
        "fact": "Rohan said little for about two hours after coming home.",
        "story": "He's upset with me. Something's wrong between us.",
        "prompt": "Before you go further — write the fact in one line, and the story in one line. Keep them separate."
      },
      "step2_decode": {
        "trap": "Mind Reading + Emotional Reasoning",
        "explanation": "Assuming his internal state and treating her own anxiety as proof something is wrong, with no direct evidence from him."
      },
      "step3_reality_check": {
        "q1": "Is quietness after work normal for him on some days, or is this new?",
        "q2": "What happened today that has nothing to do with her — deadlines, traffic, a hard conversation at work?",
        "q3": "Has he actually said or done anything pointed at her, or is this silence alone?",
        "q4": "If a friend described this exact scene, would she assume the same thing about their marriage?",
        "q5": "What's the actual evidence he's upset with her, versus just upset, tired, or elsewhere in his head?"
      },
      "step4_reframe": {
        "option1": "He had a rough day at work and is decompressing — nothing to do with her.",
        "option2": "He's mentally stuck on a problem and hasn't switched contexts yet.",
        "option3": "He's tired and quiet is just his low-energy default, not a signal."
      },
      "step5_intervention": {
        "action": "Instead of asking \"What's wrong with you?\" she says: \"You've been quiet — long day?\" — then gives him room to answer.",
        "rationale": "A single low-stakes opener invites disclosure without triggering defensiveness."
      },
      "step6_internalize": {
        "principle": "Silence is not a message. It's a blank I fill in — check before I fill it with the worst option."
      }
    }
  }
}
```

---

### 2.2 Submit Daily Reflection
- **Endpoint**: `POST /cases/submit-reflection`
- **Authentication**: Bearer Token Required
- **Description**: Stores the user's 1-line `INTERNALIZE™` principle (Minimal Retention Rule) and increments their `current_day` counter (Day 1 → 60).

#### Request Body
```json
{
  "case_id": 1,
  "internalize_text": "Silence is not a message. It's a blank I fill in — check before I fill it with the worst option."
}
```

#### Field Specifications
| Parameter | Type | Required | Description |
| :--- | :--- | :--- | :--- |
| `case_id` | Integer | Yes | The ID of the completed case study. |
| `internalize_text` | String | Yes | The 1-line principle learned (max 280 characters). |

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Reflection recorded successfully.",
  "data": {
    "reflection": {
      "id": 1,
      "user_id": 2,
      "case_id": 1,
      "day_number": 7,
      "internalize_text": "Silence is not a message. It's a blank I fill in — check before I fill it with the worst option.",
      "submitted_at": "2026-07-23T22:45:00.000000Z"
    },
    "next_day": 8,
    "phase": 1
  }
}
```

---

## 3. 60-Day Foundation Course Feedback Survey (PDF 1 Spec)

### 3.1 Submit 60-Day Foundation Feedback
- **Endpoint**: `POST /foundation-feedback`
- **Authentication**: Bearer Token Required
- **Trigger**: When the user completes Day 60 (`current_day >= 60`). Single page / modal in app.

#### Request Body (Example 1: High Impact Score ≥ 4)
```json
{
  "judgment_impact_score": 5,
  "technique_applied": "multiple",
  "recommend_score": 5,
  "testimonial_text": "ThinkClear completely changed how I think under uncertainty."
}
```

#### Request Body (Example 2: Low Impact Score ≤ 2)
```json
{
  "judgment_impact_score": 2,
  "technique_applied": "not_yet",
  "recommend_score": 2,
  "improvement_feedback": "I would like more scenarios related to workplace negotiations."
}
```

#### Field Specifications (PDF 1 Data Schema)
| Field Name | Type | Required | Values / Validation Notes |
| :--- | :--- | :--- | :--- |
| `judgment_impact_score` | Integer | Yes | `1` to `5` rating scale (1 = Not at all, 5 = Very significantly). |
| `technique_applied` | Enum String | Yes | Must be one of: `"multiple"`, `"once_or_twice"`, `"not_yet"`, `"dont_remember"`. |
| `recommend_score` | Integer | Yes | `1` to `5` rating scale (1 = Definitely not, 5 = Definitely yes). |
| `testimonial_text` | String | Conditional | Max 280 characters. Shown conditionally when `judgment_impact_score >= 4`. |
| `improvement_feedback` | String | Conditional | Max 280 characters. Shown conditionally when `judgment_impact_score <= 2`. |

#### Success Response (`201 Created`)
```json
{
  "status": "success",
  "message": "Thank you for your feedback. It helps us keep improving ThinkClear.",
  "data": {
    "id": 1,
    "user_id": 2,
    "judgment_impact_score": 5,
    "technique_applied": "multiple",
    "recommend_score": 5,
    "testimonial_text": "ThinkClear completely changed how I think under uncertainty.",
    "improvement_feedback": null,
    "submitted_at": "2026-07-23T22:50:00.000000Z"
  }
}
```

---

### 3.2 Check Feedback Submission Status
- **Endpoint**: `GET /foundation-feedback/check`
- **Authentication**: Bearer Token Required
- **Description**: Check if the current user has already submitted the 60-day survey.

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "data": {
    "has_submitted": false,
    "can_trigger": true
  }
}
```

---

