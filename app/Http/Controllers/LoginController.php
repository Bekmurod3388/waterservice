<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;

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

    public function register(RegisterRequest $request)
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
