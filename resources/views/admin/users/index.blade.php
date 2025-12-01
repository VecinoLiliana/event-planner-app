<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index'),
    ],
]" title="Usuarios">

    <div class="px-4 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Nuevo usuario</a>
    </div>

    @if(session('status'))
        <div class="mb-4 p-3 rounded bg-green-50 text-green-700">{{ session('status') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($users as $user)
                <tr>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->roles->pluck('name')->join(', ') ?: '—' }}</td>
                    <td class="px-4 py-2">
                        @if($user->is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Activo</span>
                        @else
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Desactivado</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded">Editar</a>
                        @if($user->is_active)
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-sm bg-red-100 hover:bg-red-200 text-red-700 rounded">Desactivar</button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.activate', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1 text-sm bg-green-100 hover:bg-green-200 text-green-700 rounded">Activar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
    </div>

</x-admin-layout>