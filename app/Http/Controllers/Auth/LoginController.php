<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        return view("auth.login");
    }


    
}
