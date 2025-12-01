<x-admin-layout 
    title="Editar evento"
    :breadcrumbs="[
        ['name' => 'Eventos', 'href' => route('admin.events.index')],
        ['name' => 'Editar'],
    ]"
>

    <div class="px-4 py-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-semibold mb-4">Editar evento</h1>

        <form action="{{ route('admin.events.update', $event) }}" method="POST"
              class="bg-white shadow rounded p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $event->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha y hora</label>
                    <input type="datetime-local" name="date" 
                           value="{{ old('date', $event->date->format('Y-m-d\TH:i')) }}"
                           class="mt-1 block w-full border-gray-300 rounded"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Lugar</label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}"
                           class="mt-1 block w-full border-gray-300 rounded">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded">{{ old('description', $event->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="scheduled" @selected($event->status === 'scheduled')>Programado</option>
                    <option value="cancelled" @selected($event->status === 'cancelled')>Cancelado</option>
                    <option value="done" @selected($event->status === 'done')>Realizado</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.events.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Actualizar</button>
            </div>

        </form>

    </div>

</x-admin-layout>