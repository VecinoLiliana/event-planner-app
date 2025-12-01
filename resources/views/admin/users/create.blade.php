<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index'),
    ],
    [
        'name' => 'Crear usuario',
    ],
]" title="Crear usuario">

    <div class="px-4 py-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Crear usuario</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded" required>
                @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="role" class="mt-1 block w-full border-gray-300 rounded" required>
                <option value="">Seleccione rol…</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" @selected(old('role')===$role->name)>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" name="id_number" value="{{ old('id_number') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="address" value="{{ old('address') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Guardar</button>
        </div>
    </form>
    </div>

</x-admin-layout>