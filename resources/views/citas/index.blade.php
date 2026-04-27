<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    📅 Citas
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Agenda de citas registradas
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('citas.calendario') }}"
                   class="w-full sm:w-auto text-center bg-purple-100 hover:bg-purple-200 text-purple-700 px-5 py-2 rounded-xl font-semibold transition">
                    Ver calendario
                </a>

                <a href="{{ route('citas.create') }}"
                   class="w-full sm:w-auto text-center bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-xl shadow font-semibold transition">
                    + Nueva cita
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 p-4 sm:p-6">

                <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">
                            Citas registradas
                        </h3>
                        <p class="text-sm text-gray-500">
                            Control general de la agenda clínica
                        </p>
                    </div>

                    <span class="bg-pink-50 text-pink-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Total: {{ $citas->count() }}
                    </span>
                </div>

                {{-- MOBILE --}}
                <div class="space-y-4 md:hidden">
                    @forelse($citas as $cita)
                        @php
                            $estadoClase = match($cita->estado) {
                                'pendiente' => 'bg-yellow-100 text-yellow-700',
                                'programada' => 'bg-sky-100 text-sky-700',
                                'confirmada' => 'bg-blue-100 text-blue-700',
                                'atendida' => 'bg-green-100 text-green-700',
                                'cancelada' => 'bg-red-100 text-red-700',
                                'no_asistio' => 'bg-gray-200 text-gray-700',
                                default => 'bg-pink-100 text-pink-700',
                            };
                        @endphp

                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-pink-50 p-4 shadow-sm">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-400 font-bold">
                                        {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                    </p>

                                    <h4 class="text-lg font-bold text-gray-800 mt-1">
                                        {{ $cita->paciente->nombre ?? 'Paciente' }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ substr($cita->hora_inicio,0,5) }} - {{ substr($cita->hora_fin,0,5) }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $estadoClase }}">
                                    {{ str_replace('_',' ', ucfirst($cita->estado)) }}
                                </span>
                            </div>

                            <div class="mt-4 text-sm space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Fisio</span>
                                    <span class="font-semibold text-gray-700 text-right">
                                        {{ $cita->fisioterapeuta->user->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400">Sala</span>
                                    <span class="font-semibold text-gray-700 text-right">
                                        {{ $cita->sala->nombre ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-col gap-2">
                                <a href="{{ route('citas.edit', $cita) }}"
                                   class="text-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl font-semibold">
                                    Editar
                                </a>

                                <form action="{{ route('citas.destroy', $cita) }}"
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
                            <div class="text-5xl mb-3">🗓️</div>
                            <p class="text-gray-500 font-semibold">
                                No hay citas registradas todavía.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- DESKTOP --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700">
                                <th class="p-3 text-left rounded-l-xl">Fecha</th>
                                <th class="p-3 text-left">Hora</th>
                                <th class="p-3 text-left">Paciente</th>
                                <th class="p-3 text-left">Fisio</th>
                                <th class="p-3 text-left">Sala</th>
                                <th class="p-3 text-left">Estado</th>
                                <th class="p-3 text-center rounded-r-xl">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($citas as $cita)
                                @php
                                    $estadoClase = match($cita->estado) {
                                        'pendiente' => 'bg-yellow-100 text-yellow-700',
                                        'programada' => 'bg-sky-100 text-sky-700',
                                        'confirmada' => 'bg-blue-100 text-blue-700',
                                        'atendida' => 'bg-green-100 text-green-700',
                                        'cancelada' => 'bg-red-100 text-red-700',
                                        'no_asistio' => 'bg-gray-200 text-gray-700',
                                        default => 'bg-pink-100 text-pink-700',
                                    };
                                @endphp

                                <tr class="border-b hover:bg-pink-50/60 transition">
                                    <td class="p-3 font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                    </td>

                                    <td class="p-3 text-gray-600">
                                        {{ substr($cita->hora_inicio,0,5) }} - {{ substr($cita->hora_fin,0,5) }}
                                    </td>

                                    <td class="p-3 font-semibold text-gray-700">
                                        {{ $cita->paciente->nombre ?? 'Paciente' }}
                                    </td>

                                    <td class="p-3 text-gray-600">
                                        {{ $cita->fisioterapeuta->user->name ?? 'N/A' }}
                                    </td>

                                    <td class="p-3 text-gray-600">
                                        {{ $cita->sala->nombre ?? 'N/A' }}
                                    </td>

                                    <td class="p-3">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $estadoClase }}">
                                            {{ str_replace('_',' ', ucfirst($cita->estado)) }}
                                        </span>
                                    </td>

                                    <td class="p-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('citas.edit', $cita) }}"
                                               class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg font-semibold">
                                                Editar
                                            </a>

                                            <form action="{{ route('citas.destroy', $cita) }}"
                                                  method="POST"
                                                  class="form-eliminar">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg font-semibold">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-gray-500">
                                        No hay citas registradas todavía.
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