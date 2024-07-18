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
        $user = User::where('phone', $data['phone'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid account information',
            'errors' => ['phone' => 'Hisob maʼlumotlari yaroqsiz']
        ], 422);
    }

//    public function register(RegisterRequest $request): JsonResponse
//    {
//        $data = $request->only(['username', 'password', 'phone']);
//        $user = User::create([
//            'username' => $data['username'],
//            'password' => Hash::make($data['password']),
//            'phone' => $data['phone'],
//        ]);
//
//        Auth::login($user);
//        $token = $user->createToken('API Token')->plainTextToken;
//
//        return response()->json([
//            'message' => 'Registration successful',
//            'data' => [
//                'user' => $user,
//                'token' => $token,
//            ],
//        ], 201);
//    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }
}
