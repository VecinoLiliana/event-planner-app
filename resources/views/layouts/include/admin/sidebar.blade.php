@php
    // Enlaces del sidebar
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Gestión',
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'href' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
        [
            'name' => 'Roles y permisos',
            'icon' => 'fa-solid fa-shield-halved',
            'href' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
        ],
        [
            'name' => 'Eventos',
            'icon' => 'fa-solid fa-calendar-days',
            'href' => route('admin.events.index'),
            'active' => request()->routeIs('admin.events.*'),
        ],
    ];
@endphp

<aside id="top-bar-sidebar" class="fixed top-16 sm:top-20 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center ps-2.5 mb-5">
            <img src="{{ asset('images/LogoLoopEvents.svg') }}" class="h-6 me-3" alt="LoopEvents Logo" />
            <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">LoopEvents</span>
        </a>
        <ul class="space-y-2 font-medium">
            @foreach($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase">
                            {{ $link['header'] }}
                        </div>
                    @else
                        <a href="{{ $link['href'] }}"
                           class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
                          {{ $link['active'] ? 'bg-gray-200 dark:bg-gray-600' : '' }}">
                            <i class="{{ $link['icon'] }} w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                            <span class="ml-3">{{ $link['name'] }}</span>
                        </a>
                    @endisset
                </li>
            @endforeach
            <!-- Enlaces limpios sin elementos de demo -->
        </ul>
    </div>
</aside>
