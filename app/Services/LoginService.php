<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function login(array $data)
    {
        $user = User::query()
            ->withoutRole('dealer')
            ->withoutRole('agent')
            ->withoutRole('cashier')
            ->where('phone', $data['phone'])
            ->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
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
