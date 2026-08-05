# ThinkClear Mobile Application - REST API Specification & Handoff Document

**Document Status**: Production Ready  
**Base URL**: `http://YOUR_SERVER_IP:8000/api/v1` (Local testing: `http://192.168.29.154:8000/api/v1` or `http://localhost:8000/api/v1`)  
**Data Format**: JSON  

---

## 🔑 Common Request Headers

All API requests (except `/register`, `/login`, `/social-login`, `/forgot-password`, `/reset-password`) require the `Authorization` header containing the Sanctum Bearer token received upon authentication.

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

---

### 1.2 User Login
- **Endpoint**: `POST /login`
- **Authentication**: None (Public)

---

### 1.3 Social Login (Google & Apple Auth)
- **Endpoint**: `POST /social-login`
- **Authentication**: None (Public)

---

### 1.4 Forgot Password (Request 6-Digit OTP)
- **Endpoint**: `POST /forgot-password`
- **Authentication**: None (Public)

---

### 1.5 Reset Password (Using OTP)
- **Endpoint**: `POST /reset-password`
- **Authentication**: None (Public)

---

## 2. Curriculum & Scenario Endpoints

### 2.1 Get Today's Scenario (`GET /cases/today`)
- **Endpoint**: `GET /cases/today`
- **Authentication**: Bearer Token Required
- **Description**: Returns the active scenario case matching the user's `current_day` (Day 1 through Day 60) along with all 6 framework steps, prompts, multiple-choice options, insights, tips, and model answers.

---

### 2.2 Submit Reflection (`POST /cases/submit-reflection`)
- **Endpoint**: `POST /cases/submit-reflection`
- **Authentication**: Bearer Token Required
- **Description**: Saves the user's 1-line principle for the day. Supports an optional `increment_day` boolean parameter.

#### Request Body
```json
{
  "case_id": 1,
  "internalize_text": "A delayed reply is a fact. Being ignored is a story until evidence proves otherwise.",
  "increment_day": false
}
```

---

### 2.3 Explicit Increment / Next Day (`POST /cases/next-day` or `POST /cases/increment-day`)
- **Endpoint**: `POST /cases/next-day`
- **Authentication**: Bearer Token Required
- **Description**: Explicitly advances the student to the next day (`current_day + 1`) and updates their phase.

#### Request Body
`{}` (Empty or optional parameters)

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Student day advanced successfully.",
  "data": {
    "current_day": 2,
    "phase": 1
  }
}
```
