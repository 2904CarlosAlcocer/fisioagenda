<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    🧑‍⚕️ Fisioterapeutas
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Administración del personal clínico
                </p>
            </div>

            <a href="{{ route('fisioterapeutas.create') }}"
               class="w-full sm:w-auto text-center bg-gradient-to-r from-pink-500 to-purple-500 text-white px-5 py-3 rounded-xl shadow font-semibold">
                + Nueva Fisioterapeuta
            </a>
        </div>
    </x-slot>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-3 sm:px-6">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 sm:p-6">

                <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            Lista de Fisioterapeutas
                        </h3>
                        <p class="text-sm text-gray-500">
                            Control de profesionales asignadas al sistema
                        </p>
                    </div>

                    <span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Total: {{ $fisioterapeutas->count() }}
                    </span>
                </div>

                {{-- MOBILE --}}
                <div class="space-y-4 md:hidden">
                    @forelse($fisioterapeutas as $fisio)
                        @php
                            $color = $fisio->estado === 'activo'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-200 text-gray-700';
                        @endphp

                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-pink-50 p-4 shadow-sm">
                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800">
                                        {{ $fisio->user->name ?? 'Sin usuario' }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $fisio->especialidad ?: 'Sin especialidad' }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $color }}">
                                    {{ ucfirst($fisio->estado) }}
                                </span>
                            </div>

                            <div class="mt-4 text-sm space-y-2">
                                <div class="flex justify-between gap-3">
                                    <span class="text-gray-400">Teléfono</span>
                                    <span class="font-semibold text-gray-700 text-right">
                                        {{ $fisio->telefono ?: 'N/A' }}
                                    </span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-gray-400">Horario</span>
                                    <span class="font-semibold text-gray-700 text-right">
                                        {{ $fisio->horario ?: 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-col gap-2">
                                <a href="{{ route('fisioterapeutas.edit', $fisio) }}"
                                   class="text-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl font-semibold">
                                    Editar
                                </a>

                                <form action="{{ route('fisioterapeutas.destroy', $fisio) }}"
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
                            <div class="text-5xl mb-3">🧑‍⚕️</div>
                            <p class="text-gray-400">
                                No hay fisioterapeutas registradas
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
                                <th class="px-4 py-3 text-left">Especialidad</th>
                                <th class="px-4 py-3 text-left">Teléfono</th>
                                <th class="px-4 py-3 text-left">Horario</th>
                                <th class="px-4 py-3 text-left">Estado</th>
                                <th class="px-4 py-3 text-center rounded-r-xl">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($fisioterapeutas as $fisio)
                                @php
                                    $color = $fisio->estado === 'activo'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-gray-200 text-gray-700';
                                @endphp

                                <tr class="border-b hover:bg-pink-50/50">
                                    <td class="px-4 py-4 font-semibold text-gray-700">
                                        {{ $fisio->user->name ?? 'Sin usuario' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $fisio->especialidad ?: 'Sin especialidad' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $fisio->telefono ?: 'N/A' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $fisio->horario ?: 'N/A' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $color }}">
                                            {{ ucfirst($fisio->estado) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('fisioterapeutas.edit', $fisio) }}"
                                               class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-xl font-semibold">
                                                Editar
                                            </a>

                                            <form action="{{ route('fisioterapeutas.destroy', $fisio) }}"
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
                                        No hay fisioterapeutas registradas
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