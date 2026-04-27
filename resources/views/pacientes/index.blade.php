<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    👥 Pacientes
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Gestión de pacientes registrados
                </p>
            </div>

            <a href="{{ route('pacientes.create') }}"
               class="w-full sm:w-auto text-center bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-xl shadow font-semibold transition">
                + Nuevo paciente
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 p-4 sm:p-6">

                <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">
                            Lista de pacientes
                        </h3>
                        <p class="text-sm text-gray-500">
                            Historial y administración clínica
                        </p>
                    </div>

                    <span class="bg-pink-50 text-pink-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Total: {{ $pacientes->count() }}
                    </span>
                </div>

                {{-- MOBILE --}}
                <div class="space-y-4 md:hidden">
                    @forelse($pacientes as $paciente)
                        @php
                            $estadoClase = $paciente->estado === 'activo'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-200 text-gray-700';
                        @endphp

                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-pink-50 p-4 shadow-sm">
                            <div class="flex justify-between gap-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800">
                                        {{ $paciente->nombre }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $paciente->telefono }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $estadoClase }}">
                                    {{ ucfirst($paciente->estado) }}
                                </span>
                            </div>

                            <div class="mt-4 space-y-2 text-sm">
                                <div class="flex justify-between gap-3">
                                    <span class="text-gray-400">Edad</span>
                                    <span class="font-semibold text-gray-700">
                                        {{ $paciente->edad ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-gray-400">Motivo</span>
                                    <span class="font-semibold text-gray-700 text-right">
                                        {{ Str::limit($paciente->motivo_visita, 35) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-1 gap-2">
                                <a href="{{ route('pacientes.show', $paciente) }}"
                                   class="text-center bg-cyan-100 hover:bg-cyan-200 text-cyan-700 px-4 py-2 rounded-xl font-semibold transition">
                                    Ver
                                </a>

                                <a href="{{ route('pacientes.edit', $paciente) }}"
                                   class="text-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl font-semibold transition">
                                    Editar
                                </a>

                                <form action="{{ route('pacientes.destroy', $paciente) }}"
                                      method="POST"
                                      class="form-eliminar">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl font-semibold transition">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>

                    @empty
                        <div class="text-center py-12">
                            <div class="text-5xl mb-3">👤</div>
                            <p class="text-gray-500 font-semibold">
                                No hay pacientes registrados todavía.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- DESKTOP --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700">
                                <th class="p-3 text-left rounded-l-xl">Nombre</th>
                                <th class="p-3 text-left">Teléfono</th>
                                <th class="p-3 text-left">Edad</th>
                                <th class="p-3 text-left">Motivo</th>
                                <th class="p-3 text-left">Estado</th>
                                <th class="p-3 text-center rounded-r-xl">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pacientes as $paciente)
                                @php
                                    $estadoClase = $paciente->estado === 'activo'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-gray-200 text-gray-700';
                                @endphp

                                <tr class="border-b hover:bg-pink-50/60 transition">
                                    <td class="p-3 font-semibold text-gray-700">
                                        {{ $paciente->nombre }}
                                    </td>

                                    <td class="p-3 text-gray-600">
                                        {{ $paciente->telefono }}
                                    </td>

                                    <td class="p-3 text-gray-600">
                                        {{ $paciente->edad ?? 'N/A' }}
                                    </td>

                                    <td class="p-3 text-gray-600">
                                        {{ Str::limit($paciente->motivo_visita, 45) }}
                                    </td>

                                    <td class="p-3">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $estadoClase }}">
                                            {{ ucfirst($paciente->estado) }}
                                        </span>
                                    </td>

                                    <td class="p-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('pacientes.show', $paciente) }}"
                                               class="bg-cyan-100 hover:bg-cyan-200 text-cyan-700 px-3 py-1 rounded-lg font-semibold transition">
                                                Ver
                                            </a>

                                            <a href="{{ route('pacientes.edit', $paciente) }}"
                                               class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg font-semibold transition">
                                                Editar
                                            </a>

                                            <form action="{{ route('pacientes.destroy', $paciente) }}"
                                                  method="POST"
                                                  class="form-eliminar">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg font-semibold transition">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">
                                        No hay pacientes registrados todavía.
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