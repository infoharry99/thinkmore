<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'current_day' => 1,
            'phase' => 0,
            'role' => 'user',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], 201);
    }

    /**
     * Login user & return Sanctum token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! $user->password || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Logged in successfully',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    /**
     * Social Authentication (Google & Apple OAuth Login/Register)
     */
    public function socialLogin(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|string|in:google,apple',
            'provider_id' => 'required|string',
            'email' => 'required|email',
            'name' => 'nullable|string',
        ]);

        // Find existing user by provider_id or email
        $user = User::where('provider', $validated['provider'])
            ->where('provider_id', $validated['provider_id'])
            ->orWhere('email', $validated['email'])
            ->first();

        if ($user) {
            // Update provider info if not already associated
            $user->update([
                'provider' => $validated['provider'],
                'provider_id' => $validated['provider_id'],
            ]);
        } else {
            // Create new social user
            $user = User::create([
                'name' => $validated['name'] ?? explode('@', $validated['email'])[0],
                'email' => $validated['email'],
                'provider' => $validated['provider'],
                'provider_id' => $validated['provider_id'],
                'password' => null, // Social user without password
                'current_day' => 1,
                'phase' => 0,
                'role' => 'user',
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Social login successful',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    /**
     * Forgot Password - Send OTP to Email
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate 6-digit OTP
        $otp = sprintf('%06d', mt_rand(100000, 999999));

        PasswordResetOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(15),
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset OTP has been sent to your email.',
            'data' => [
                'email' => $request->email,
                'otp_debug' => $otp, // Useful for app developer testing
                'expires_in_minutes' => 15,
            ]
        ]);
    }

    /**
     * Reset Password using OTP
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
            'password' => 'required|string|min:8',
        ]);

        $resetRecord = PasswordResetOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (! $resetRecord || $resetRecord->expires_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired OTP code.',
            ], 400);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Delete used OTP
        $resetRecord->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Password has been reset successfully. You can now log in with your new password.',
        ]);
    }

    /**
     * Get authenticated user profile
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
                'reflections_count' => $user->reflections()->count(),
                'is_foundation_completed' => $user->current_day >= 60,
            ]
        ]);
    }

    /**
     * Logout user (Revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
