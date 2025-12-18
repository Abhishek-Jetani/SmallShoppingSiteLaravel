<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user exists with this google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // User exists, log them in
                if ($user->status != 1) {
                    return redirect('/login')->with('error', 'Your account has been deactivated by Admin.');
                }

                if ($user->role != 2) {
                    return redirect('/login')->with('error', 'You are not authorized to access this area.');
                }

                Auth::login($user);

                if (session()->has('preintended')) {
                    return redirect(session()->get('preintended'));
                }

                return redirect('/');
            }

            // Check if user exists with this email
            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                // User exists with email but no google_id, update it
                if ($existingUser->status != 1) {
                    return redirect('/login')->with('error', 'Your account has been deactivated by Admin.');
                }

                if ($existingUser->role != 2) {
                    return redirect('/login')->with('error', 'You are not authorized to access this area.');
                }

                $existingUser->google_id = $googleUser->id;
                $existingUser->email_verified_at = now();
                $existingUser->save();

                Auth::login($existingUser);

                if (session()->has('preintended')) {
                    return redirect(session()->get('preintended'));
                }

                return redirect('/');
            }

            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make(Str::random(16)), // Random password since they're using Google
                'role' => 2, // User role
                'status' => 1, // Active
                'email_verified_at' => now(), // Google emails are already verified
            ]);

            Auth::login($newUser);

            if (session()->has('preintended')) {
                return redirect(session()->get('preintended'));
            }

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication failed. Please try again.');
        }
    }

    /**
     * Handle Google authentication via AJAX/Form POST
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function handleGoogleAuth(Request $request)
    {
        return $this->redirectToGoogle();
    }
}

