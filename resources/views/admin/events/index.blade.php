<x-admin-layout 
    title="Eventos"
    :breadcrumbs="[
        ['name' => 'Eventos', 'href' => route('admin.events.index')],
    ]"
>
    <div class="px-4 py-6">

        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold text-gray-800">Eventos</h1>
            <a href="{{ route('admin.events.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Nuevo evento
            </a>
        </div>

        @if(session('status'))
            <div class="mb-4 p-3 rounded bg-green-50 text-green-700">{{ session('status') }}</div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Lugar</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td class="px-4 py-2">{{ $event->name }}</td>
                            <td class="px-4 py-2">{{ $event->date->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $event->location }}</td>
                            <td class="px-4 py-2">{{ ucfirst($event->status) }}</td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded">Editar</a>

                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-100 hover:bg-red-200 text-red-700 rounded">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $events->links() }}</div>

    </div>
</x-admin-layout>