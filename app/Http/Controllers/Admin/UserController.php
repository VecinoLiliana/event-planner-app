<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /** Display a listing of the users. */
    public function index()
    {
        $users = User::query()->orderBy('name')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /** Show the form for creating a new user. */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    /** Store a newly created user in storage. */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
            'id_number' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'id_number' => $validated['id_number'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('status', 'Usuario creado correctamente');
    }

    /** Show the form for editing the specified user. */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        $userRole = $user->roles()->first()?->name;
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /** Update the specified user in storage. */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'. $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
            'id_number' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'id_number' => $validated['id_number'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'is_active' => $validated['is_active'] ?? $user->is_active,
        ]);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Sync único rol para simplicidad
        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('status', 'Usuario actualizado correctamente');
    }

    /** Soft-deactivate the user without deleting. */
    public function destroy(User $user)
    {
        $user->is_active = false;
        $user->save();

        return redirect()->route('admin.users.index')->with('status', 'Usuario desactivado');
    }

    /** Reactivate a previously deactivated user. */
    public function activate(User $user)
    {
        $user->is_active = true;
        $user->save();
        return redirect()->route('admin.users.index')->with('status', 'Usuario activado');
    }
}