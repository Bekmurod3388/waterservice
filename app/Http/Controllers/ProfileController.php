<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profiles\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.my_profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi!');
    }
}
