<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3|max:25',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('login')->withInput()->withErrors($validator);
        }
        
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('loginText')->plainTextToken;
    
            return redirect()->route('dashboard')
                ->with('success', 'Thank you for logging in')
                ->with('token', $token);
        }
    
        return redirect()->route('login')
            ->withInput()
            ->with('error', 'Your credentials failed');
    }
    
    public function logout(Request $request)
    {
        $user = $request->user();
    
        $user->tokens()->delete();
    
        return redirect()->route('login')->with('message', 'Logged out successfully');
    }
    
}
