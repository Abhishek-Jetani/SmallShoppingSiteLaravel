<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Handle Google Sign-In/Sign-Up
     */
    public function handleGoogleAuth(Request $request)
    {
        try {
            $token = $request->input('token');
            $type = $request->input('type', 'login');

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token is required'
                ], 400);
            }

            // Verify and decode the JWT token
            $decoded = $this->verifyGoogleToken($token);

            if (!$decoded) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token'
                ], 401);
            }

            $email = $decoded->email;
            $name = $decoded->name;

            // Check if user exists
            $user = User::where('email', $email)->first();

            if ($type === 'signup') {
                if ($user) {
                    // User already exists, log them in instead
                    if ($user->status == 0) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Your account has been deactivated'
                        ], 403);
                    }
                    Auth::login($user);
                    return response()->json([
                        'success' => true,
                        'message' => 'User already exists',
                        'redirect' => route('home')
                    ]);
                }

                // Create new user
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make(Str::random(32)),
                    'email_verified_at' => now(),
                    'role' => 2, // User role
                    'status' => 1,
                ]);

                Auth::login($user);

                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully',
                    'redirect' => route('home')
                ]);
            } else { // login
                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No account found with this email. Please register first.'
                    ], 404);
                }

                if ($user->status == 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your account has been deactivated by admin'
                    ], 403);
                }

                if ($user->role != 2) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid user role'
                    ], 403);
                }

                Auth::login($user);

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect' => route('home')
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify Google ID Token
     */
    private function verifyGoogleToken($token)
    {
        try {
            $clientId = config('services.google.client_id');

            // Get public keys from Google
            $publicKeysUrl = 'https://www.googleapis.com/oauth2/v1/certs';
            $publicKeys = json_decode(file_get_contents($publicKeysUrl), true);

            // Get the key ID from the token header
            $tokenParts = explode('.', $token);
            $headerBase64 = $tokenParts[0];
            $header = json_decode(base64_decode(strtr($headerBase64, '-_', '+/')), true);
            $keyId = $header['kid'] ?? null;

            if (!$keyId || !isset($publicKeys[$keyId])) {
                // Try with first available key if kid not found
                $keyId = array_key_first($publicKeys);
            }

            $publicKey = $publicKeys[$keyId] ?? null;

            if (!$publicKey) {
                return null;
            }

            // Verify the token
            $decoded = JWT::decode(
                $token,
                new Key($publicKey, 'RS256')
            );

            // Verify the audience
            if ($decoded->aud !== $clientId) {
                return null;
            }

            return $decoded;
        } catch (\Exception $e) {
            \Log::error('Token Verification Error: ' . $e->getMessage());
            return null;
        }
    }
}
