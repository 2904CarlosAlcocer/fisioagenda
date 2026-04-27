<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    🏥 Salas
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Administración de salas clínicas
                </p>
            </div>

            <a href="{{ route('salas.create') }}"
               class="w-full sm:w-auto text-center bg-gradient-to-r from-pink-500 to-purple-500 text-white px-5 py-3 rounded-xl shadow font-semibold">
                + Nueva Sala
            </a>
        </div>
    </x-slot>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-3 sm:px-6">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 sm:p-6">

                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">
                        Lista de Salas
                    </h3>

                    <span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Total: {{ $salas->count() }}
                    </span>
                </div>

                {{-- MOBILE --}}
                <div class="space-y-4 md:hidden">
                    @forelse($salas as $sala)
                        @php
                            $color = match($sala->estado){
                                'disponible' => 'bg-green-100 text-green-700',
                                'ocupada' => 'bg-yellow-100 text-yellow-700',
                                'mantenimiento' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp

                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-pink-50 p-4 shadow-sm">

                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800">
                                        {{ $sala->nombre }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $sala->ubicacion ?: 'Sin ubicación' }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $color }}">
                                    {{ ucfirst($sala->estado) }}
                                </span>
                            </div>

                            <div class="mt-4 text-sm space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Capacidad</span>
                                    <span class="font-semibold text-gray-700">
                                        {{ $sala->capacidad ?: 'N/A' }}
                                    </span>
                                </div>

                                @if($sala->descripcion)
                                    <div>
                                        <span class="text-gray-400">Descripción</span>
                                        <p class="font-semibold text-gray-700 mt-1">
                                            {{ Str::limit($sala->descripcion, 80) }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 flex flex-col gap-2">
                                <a href="{{ route('salas.edit', $sala) }}"
                                   class="text-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl font-semibold">
                                    Editar
                                </a>

                                <form action="{{ route('salas.destroy', $sala) }}"
                                      method="POST"
                                      class="form-eliminar">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl font-semibold">
                                        Eliminar
                                    </button>
                                </form>
                            </div>

                        </div>

                    @empty
                        <div class="text-center py-12">
                            <div class="text-5xl mb-3">🏥</div>
                            <p class="text-gray-400">
                                No hay salas registradas
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- DESKTOP --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700">
                                <th class="px-4 py-3 text-left rounded-l-xl">Nombre</th>
                                <th class="px-4 py-3 text-left">Ubicación</th>
                                <th class="px-4 py-3 text-left">Capacidad</th>
                                <th class="px-4 py-3 text-left">Estado</th>
                                <th class="px-4 py-3 text-left">Descripción</th>
                                <th class="px-4 py-3 text-center rounded-r-xl">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($salas as $sala)
                                @php
                                    $color = match($sala->estado){
                                        'disponible' => 'bg-green-100 text-green-700',
                                        'ocupada' => 'bg-yellow-100 text-yellow-700',
                                        'mantenimiento' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp

                                <tr class="border-b hover:bg-pink-50/50">
                                    <td class="px-4 py-4 font-semibold text-gray-700">
                                        {{ $sala->nombre }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $sala->ubicacion ?: 'Sin ubicación' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $sala->capacidad ?: 'N/A' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $color }}">
                                            {{ ucfirst($sala->estado) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $sala->descripcion ? Str::limit($sala->descripcion, 50) : 'Sin descripción' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('salas.edit', $sala) }}"
                                               class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-xl font-semibold">
                                                Editar
                                            </a>

                                            <form action="{{ route('salas.destroy', $sala) }}"
                                                  method="POST"
                                                  class="form-eliminar">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-xl font-semibold">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-gray-400 py-10">
                                        No hay salas registradas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>