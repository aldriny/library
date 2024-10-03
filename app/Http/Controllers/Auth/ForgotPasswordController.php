<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ErrorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    protected $errorHandler;

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validatedEmail = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        try {

            $response = Password::sendResetLink($validatedEmail);

            return $response == Password::RESET_LINK_SENT
                ? back()->with('status', trans($response))
                : back()->withErrors(['email' => trans($response)]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e);
        }
    }

    public function showResetPassword(Request $request, $token = null)
    {
        try {
            return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e);
        }
    }

    public function resetPassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);
        try {
            $response = Password::reset(
                $credentials,
                function ($user, $password) {
                    $user->password =  bcrypt($password);
                    $user->save();
                }
            );

            return $response == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('success', trans($response))
                : back()->withErrors(['email' => trans($response)]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e);
        }
    }
}
