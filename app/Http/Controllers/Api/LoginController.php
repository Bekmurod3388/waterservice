<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
//use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::query()->where('phone', $data['phone'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
        }

        return response()->json([
            'message' => 'Invalid account information',
            'errors' => ['phone' => 'Hisob maʼlumotlari yaroqsiz']
        ], 422);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|min:5|confirmed'
        ]);

        /** @var User $user */
        $user = auth()->user();
        $user->update([
            'name' => $request->get('name'),
            'phone' => $request->get('phone')
        ]);
        if (Hash::check($request->get('current_password'), $user->pasword)) {
            $user->update([
                'password' => Hash::make($request->get('new_password'))
            ]);
        } else {
            return response()->json([
                'message' => 'Update failed',
                'errors' => ['password' => 'Parol mos kelmadi']
            ]);
        }

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'user' => $user
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
