<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-sky-50 py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-3 sm:px-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-8">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                    Recordatorios
                </h1>
                <p class="text-gray-500 mt-2 text-sm sm:text-base">
                    Gestión de avisos para pacientes
                </p>
            </div>

            <a href="{{ route('recordatorios.create') }}"
               class="w-full sm:w-auto text-center bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-2xl shadow-lg font-semibold">
                + Nuevo recordatorio
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm p-4 sm:p-6 border border-purple-100">
            <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">
                        Lista de recordatorios
                    </h2>
                    <p class="text-sm text-gray-400">
                        Control de mensajes pendientes y enviados
                    </p>
                </div>

                <span class="bg-purple-100 text-purple-600 px-4 py-2 rounded-xl text-sm font-semibold">
                    Total: {{ $recordatorios->count() }}
                </span>
            </div>

            {{-- MOBILE --}}
            <div class="space-y-4 md:hidden">
                @forelse($recordatorios as $recordatorio)
                    @php
                        $enviado = $recordatorio->estado === 'enviado';
                    @endphp

                    <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-purple-50 p-4 shadow-sm">
                        <div class="flex justify-between items-start gap-3">
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">
                                    {{ $recordatorio->cita->paciente->nombre ?? 'Sin paciente' }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Cita:
                                    {{ $recordatorio->cita->fecha ?? 'Sin fecha' }}
                                    {{ substr($recordatorio->cita->hora_inicio ?? '', 0, 5) }}
                                </p>
                            </div>

                            @if($enviado)
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-bold">
                                    Enviado
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-600 text-xs font-bold">
                                    Pendiente
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 space-y-2 text-sm">
                            <div>
                                <p class="text-gray-400 font-semibold">Fecha recordatorio</p>
                                <p class="text-gray-700 font-bold">
                                    {{ $recordatorio->fecha_recordatorio }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-400 font-semibold">Mensaje</p>
                                <p class="text-gray-700">
                                    {{ $recordatorio->mensaje }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-col gap-2">
                            @if(!$enviado)
                                <form action="{{ route('recordatorios.marcarEnviado', $recordatorio) }}"
                                      method="POST"
                                      class="form-marcar-enviado">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="w-full px-4 py-2 rounded-xl bg-sky-100 hover:bg-sky-200 text-sky-700 font-semibold">
                                        Marcar enviado
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('recordatorios.destroy', $recordatorio) }}"
                                  method="POST"
                                  class="form-eliminar">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full px-4 py-2 rounded-xl bg-red-100 hover:bg-red-200 text-red-600 font-semibold">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <div class="text-center py-12">
                        <div class="text-5xl mb-3">⏰</div>
                        <p class="text-gray-400">
                            No hay recordatorios registrados
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- DESKTOP --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-purple-50 text-purple-700">
                            <th class="px-4 py-3 text-left rounded-l-xl">Paciente</th>
                            <th class="px-4 py-3 text-left">Cita</th>
                            <th class="px-4 py-3 text-left">Recordatorio</th>
                            <th class="px-4 py-3 text-left">Mensaje</th>
                            <th class="px-4 py-3 text-left">Estado</th>
                            <th class="px-4 py-3 text-center rounded-r-xl">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recordatorios as $recordatorio)
                            @php
                                $enviado = $recordatorio->estado === 'enviado';
                            @endphp

                            <tr class="border-b hover:bg-purple-50/60 transition">
                                <td class="px-4 py-4 font-semibold text-gray-700">
                                    {{ $recordatorio->cita->paciente->nombre ?? 'Sin paciente' }}
                                </td>

                                <td class="px-4 py-4 text-gray-600">
                                    {{ $recordatorio->cita->fecha ?? '' }}
                                    {{ substr($recordatorio->cita->hora_inicio ?? '', 0, 5) }}
                                </td>

                                <td class="px-4 py-4 text-gray-600">
                                    {{ $recordatorio->fecha_recordatorio }}
                                </td>

                                <td class="px-4 py-4 max-w-sm text-gray-600">
                                    {{ Str::limit($recordatorio->mensaje, 70) }}
                                </td>

                                <td class="px-4 py-4">
                                    @if($enviado)
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-sm font-semibold">
                                            Enviado
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-600 text-sm font-semibold">
                                            Pendiente
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex justify-center gap-2">
                                        @if(!$enviado)
                                            <form action="{{ route('recordatorios.marcarEnviado', $recordatorio) }}"
                                                  method="POST"
                                                  class="form-marcar-enviado">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="px-3 py-2 rounded-xl bg-sky-100 hover:bg-sky-200 text-sky-700 font-semibold">
                                                    Marcar enviado
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('recordatorios.destroy', $recordatorio) }}"
                                              method="POST"
                                              class="form-eliminar">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="px-3 py-2 rounded-xl bg-red-100 hover:bg-red-200 text-red-600 font-semibold">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-gray-400">
                                    No hay recordatorios registrados
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