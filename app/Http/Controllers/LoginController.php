<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function loginPage(){
        return view('login');
    }
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $loginSuccess = $this->loginService->login($data);

        if ($loginSuccess) {
            return redirect('/');
        } else {
            return back()->withErrors(['phone' => 'Hisob maʼlumotlari yaroqsiz'])->withInput();
        }
    }

    public function loginByUrl(Request $request, $token)
    {
        // Get token from URL query parameter

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken) {
                // Check if the token has expired
                if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
                    return response()->json(['message' => 'Token has expired'], 401);
                }

                // Set the authenticated user
                $request->setUserResolver(function () use ($accessToken) {
                    return $accessToken->tokenable;
                });
            } else {
                return response()->json(['message' => 'Invalid token'], 401);
            }
        } else {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

//        dd($accessToken);
//        if ($accessToken && !$accessToken->isExpired()) {
//            $request->setUserResolver(function () use ($accessToken) {
//                return $accessToken->tokenable;
//            });
//        }

        return redirect('mobile/agent');
    }

    public function register(Request $request)
    {
        $data = $request->only(['username', 'password']);
        $this->loginService->register($data);

        return redirect()->intended(route('tasks.index'));
    }

    public function logout(Request $request)
    {
        $this->loginService->logout($request);
        return redirect('/');
    }
}
