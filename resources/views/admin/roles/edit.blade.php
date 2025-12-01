<x-admin-layout :breadcrumbs="[
    ['name' => 'Roles', 'href' => route('admin.roles.index')],
    ['name' => 'Editar rol']
]" title="Editar Rol">

    <div class="px-4 py-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Editar rol</h1>

        <form action="{{ route('admin.roles.update', $role) }}" method="POST"
              class="bg-white shadow rounded p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded" required>

                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.roles.index') }}"
                   class="px-4 py-2 rounded border">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>