<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|exists:roles,id',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if (!empty($validatedData['password'])) {
            $user->update(['password' => bcrypt($validatedData['password'])]);
        }

        $user->roles()->sync($validatedData['roles'] ?? []);

        return redirect()->route('admin.users.index')
            ->with('success', __('Данные пользователя успешно обновлены.'));
    }
}
