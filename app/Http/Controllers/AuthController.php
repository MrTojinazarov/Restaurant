<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('livewire.auth'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && User::where($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('main.page');
        }

        return back()->withErrors(['error' => 'Email yoki parol noto\'g\'ri']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
