<?php

namespace App\Http\Controllers\auth;

use Exception;
use App\Models\User;
use App\Helpers\ErrorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\auth\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    protected $errorHandler;
    public function __construct(ErrorHandler $errorHandler){
        $this->errorHandler = $errorHandler;
    }

    public function showChangePassword(){
        return view('auth.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::user();
    
            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password you provided is incorrect.']);
            }
    
            // Hash and update the new password
            $newPassword = Hash::make($request->new_password);            
    
            User::whereId($user->id)->update([
                'password' => $newPassword,
            ]);
    
            return redirect()->route('home')->with('success', 'Password changed successfully!');
    
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e);
        }
    }
    
}
