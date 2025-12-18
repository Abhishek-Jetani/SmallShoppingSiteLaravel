<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Cache;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Handle a login request to the application.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        // Validation is handled by LoginRequest FormRequest
        // Now use the trait's logic for login attempts
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Override validateLogin to prevent duplicate validation
     * since LoginRequest already handles validation
     */
    protected function validateLogin(Request $request)
    {
        // Validation is handled by LoginRequest FormRequest
        // No need to validate again here
    }

    protected function authenticated(Request $request, $user)
    {

        if ($user->status != 1) {
            Auth::logout();
            return redirect('/login')->with('error', 'Your account has been deactivated by Admin.');
        }

        if (Auth::user()->role == 2) {
            // dd(session()->get('preintended'));
            return redirect(session()->get('preintended'));
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'you are not user');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');

        if(!session()->has('preintended'))
        {
            session()->forget('preintended');
            Cache::flush();
            session(['preintended' => url()->previous()]);
        }
    }


    
}
