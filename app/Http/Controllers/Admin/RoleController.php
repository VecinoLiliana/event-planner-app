<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);
        Role::create(['name' => $validated['name']]);
        return redirect()->route('admin.roles.index')->with('status', 'Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
        ]);
        $role->name = $validated['name'];
        $role->save();
        return redirect()->route('admin.roles.index')->with('status', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Restringir la eliminación de roles por defecto
        $protectedNames = ['Cliente', 'Organizador', 'Provedor'];

        if (in_array($role->name, $protectedNames, true)) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No puedes eliminar este rol',
            ]);

            return redirect()->route('admin.roles.index');
        }

        // Limpiar relaciones en las tablas pivot de Spatie antes de eliminar el rol
        DB::table(config('permission.table_names.model_has_roles'))
            ->where(config('permission.column_names.role_pivot_key') ?? 'role_id', $role->id)
            ->delete();

        DB::table(config('permission.table_names.role_has_permissions'))
            ->where(config('permission.column_names.role_pivot_key') ?? 'role_id', $role->id)
            ->delete();

        // Eliminar el rol directamente desde la tabla roles para evitar problemas con relaciones de Eloquent
        DB::table(config('permission.table_names.roles'))
            ->where('id', $role->id)
            ->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol eliminado exitosamente',
            'text' => 'El rol se ha eliminado correctamente',
        ]);

        return redirect()->route('admin.roles.index');
    }
}
