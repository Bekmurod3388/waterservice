<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $roles = Role::where('name', '!=', 'admin')->get();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:9',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['phone']),
        ]);

        $user->assignRole($validatedData['roles']);

        return back()->with('success', 'Foydalanuvchi muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'roles' => 'required|array',
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($validatedData['roles']);

        return back()->with('success', 'Foydalanuvchi rollari muvaffaqiyatli yangilandi!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Foydalanuvchi muvaffaqiyatli oʻchirildi!');
    }
}
