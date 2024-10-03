<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ErrorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    protected $errorHandler;

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function showVerifyEmail()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        try {
            $request->fulfill();
            $request->session()->forget('email');
            return redirect()->route('home')->with('success', 'Email verified successfully');
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Email verification failed');
        }
    }

    public function resendEmailVerification(Request $request)
    {
        try {
            $request->user()->sendEmailVerificationNotification();
            return redirect()->back()->with('success', 'Verification email sent');
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Resending email verification failed');
        }
    }
}
