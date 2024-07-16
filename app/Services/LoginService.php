<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function login(array $data)
    {
        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            return true;
        }

        return false;
    }

    public function register(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        auth()->login($user);

        return $user;
    }

    public function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
