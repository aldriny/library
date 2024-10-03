<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Helpers\ErrorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    protected $errorHandler;

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {

            $key = 'login_attempt_' . $request->ip();

            if (RateLimiter::tooManyAttempts($key,5)) {
                throw new Exception("Too many login attempts from IP: " . $request->ip());
            }

            $credentials = $request->validated();

            if (Auth::attempt($credentials)) {
                
                $user = Auth::user();

                if (!$user->hasVerifiedEmail()) {
                    session()->put('email', $credentials['email']);
                    return redirect()->route('verification.notice');
                }

                $request->session()->regenerate();
                RateLimiter::clear($key);
                return redirect()->route('home')->with('success', 'Login successful!');
            }

            RateLimiter::hit($key);
            return redirect()->route('showLogin')->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Login failed, please try again');
        }
    }
}

