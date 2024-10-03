<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Helpers\ErrorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\auth\RegisterRequest;

class RegisterController extends Controller
{
    protected $errorHandler;

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = User::create($validatedData);
            $user->sendEmailVerificationNotification();

            return redirect()->route('showLogin')->with('success', 'Registration successful. Please login.');
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Registration failed');
        }
    }
}

