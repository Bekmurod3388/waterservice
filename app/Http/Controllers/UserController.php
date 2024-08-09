<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        checkPermission('all_users');

        $search = $request->input('search');

        $usersQuery = User::query()->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        });

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->whereAny(['id', 'name', 'phone', 'latitude', 'longitude', 'last_active_time'], 'LIKE', "%$search%");
            });
        }

        $users = $usersQuery->paginate(10);

        return view('users.index', [
            'roles' => Role::where('name', '!=', 'admin')->get(),
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->phone),
        ]);

        $user->assignRole($request['roles']);

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
    public function update(UpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $user->syncRoles($request->roles);

        return back()->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi!');
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
