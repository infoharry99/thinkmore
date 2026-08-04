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
- **Description**: Registers a new student user and returns a Bearer access token.

#### Request Body
```json
{
  "name": "Arun Mishra",
  "email": "arun@example.com",
  "password": "password123"
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

---

### 1.3 Social Login (Google & Apple Auth)
- **Endpoint**: `POST /social-login`
- **Authentication**: None (Public)
- **Description**: Authenticates users signing in with Google or Apple. Creates a new account automatically if one doesn't exist, and returns a Bearer access token.

#### Request Body
```json
{
  "provider": "google",
  "provider_id": "109876543210987654321",
  "email": "social.user@gmail.com",
  "name": "Social User"
}
```

#### Field Specifications
| Parameter | Type | Required | Values / Notes |
| :--- | :--- | :--- | :--- |
| `provider` | String | Yes | Must be `"google"` or `"apple"`. |
| `provider_id` | String | Yes | OAuth User ID from Google/Apple SDK. |
| `email` | String | Yes | User's verified email address. |
| `name` | String | No | User's display name. |

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Social login successful",
  "data": {
    "user": {
      "id": 3,
      "name": "Social User",
      "email": "social.user@gmail.com",
      "provider": "google",
      "provider_id": "109876543210987654321",
      "current_day": 1,
      "phase": 0
    },
    "access_token": "3|aB9c...token_string...",
    "token_type": "Bearer"
  }
}
```

---

### 1.4 Forgot Password (Request 6-Digit OTP)
- **Endpoint**: `POST /forgot-password`
- **Authentication**: None (Public)
- **Description**: Generates a 6-digit OTP code for password reset valid for 15 minutes.

#### Request Body
```json
{
  "email": "arun@example.com"
}
```

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Password reset OTP has been sent to your email.",
  "data": {
    "email": "arun@example.com",
    "otp_debug": "123456",
    "expires_in_minutes": 15
  }
}
```

---

### 1.5 Reset Password (Using OTP)
- **Endpoint**: `POST /reset-password`
- **Authentication**: None (Public)
- **Description**: Resets user password using the 6-digit OTP code received in email.

#### Request Body
```json
{
  "email": "arun@example.com",
  "otp": "123456",
  "password": "newpassword123"
}
```

#### Success Response (`200 OK`)
```json
{
  "status": "success",
  "message": "Password has been reset successfully. You can now log in with your new password."
}
```

---

### 1.6 Get User Profile & Progress
- **Endpoint**: `GET /user/profile`
- **Authentication**: Bearer Token Required

---

### 1.7 User Logout
- **Endpoint**: `POST /logout`
- **Authentication**: Bearer Token Required
