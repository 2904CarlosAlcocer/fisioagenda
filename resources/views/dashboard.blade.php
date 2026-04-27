<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-sky-50 py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-3 sm:px-6">

        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:justify-between lg:items-center">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                    Dashboard Principal
                </h1>

                <p class="text-gray-500 mt-2 text-sm sm:text-base">
                    Centro de control de FisioAgenda Pro
                </p>
            </div>

            <a href="{{ route('citas.create') }}"
               class="w-full lg:w-auto text-center bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-2xl shadow-lg hover:scale-105 transition font-semibold">
                + Nueva cita
            </a>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            <div class="bg-white rounded-3xl shadow-sm p-6 border border-sky-100">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Citas Hoy</p>
                    <span class="text-3xl">📅</span>
                </div>

                <h2 class="text-4xl sm:text-5xl font-bold text-sky-500 mt-3">
                    {{ $citasHoy }}
                </h2>

                <p class="text-sm text-gray-400 mt-2">
                    Agendadas para hoy
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border border-pink-100">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Pacientes</p>
                    <span class="text-3xl">👥</span>
                </div>

                <h2 class="text-4xl sm:text-5xl font-bold text-pink-500 mt-3">
                    {{ $pacientes }}
                </h2>

                <p class="text-sm text-gray-400 mt-2">
                    Registrados
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border border-purple-100">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Pendientes</p>
                    <span class="text-3xl">⏰</span>
                </div>

                <h2 class="text-4xl sm:text-5xl font-bold text-purple-500 mt-3">
                    {{ $programadas }}
                </h2>

                <p class="text-sm text-gray-400 mt-2">
                    Por atender
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border border-green-100">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Salas</p>
                    <span class="text-3xl">🏥</span>
                </div>

                <h2 class="text-4xl sm:text-5xl font-bold text-green-500 mt-3">
                    {{ $salas }}
                </h2>

                <p class="text-sm text-gray-400 mt-2">
                    Disponibles
                </p>
            </div>

        </div>

        {{-- Main --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Chart --}}
            <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm p-4 sm:p-6 border border-purple-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">
                            Actividad semanal
                        </h2>

                        <p class="text-gray-400 text-sm">
                            Citas agendadas esta semana
                        </p>
                    </div>

                    <span class="bg-purple-100 text-purple-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Semana actual
                    </span>
                </div>

                <canvas id="graficoCitas" height="110"></canvas>
            </div>

            {{-- Próximas --}}
            <div class="bg-white rounded-3xl shadow-sm p-6 border border-sky-100">

                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1">
                    Próximas citas
                </h2>

                <p class="text-gray-400 text-sm mb-6">
                    Agenda rápida de hoy
                </p>

                <div class="space-y-4">

                    @forelse($proximas as $cita)

                        @php
                            $estadoClase = match($cita->estado) {
                                'pendiente' => 'text-yellow-600',
                                'confirmada' => 'text-blue-600',
                                'atendida' => 'text-green-600',
                                'cancelada' => 'text-red-600',
                                default => 'text-pink-600'
                            };
                        @endphp

                        <div class="p-4 rounded-2xl bg-gradient-to-r from-sky-50 to-purple-50 border border-sky-100">
                            <div class="flex justify-between items-start gap-3">

                                <div>
                                    <p class="font-bold text-gray-800">
                                        {{ $cita->paciente->nombre }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ substr($cita->hora_inicio,0,5) }} - {{ substr($cita->hora_fin,0,5) }}
                                    </p>

                                    <p class="text-sm mt-1 font-semibold {{ $estadoClase }}">
                                        {{ ucfirst($cita->estado) }}
                                    </p>
                                </div>

                                <span class="text-2xl">🩺</span>

                            </div>
                        </div>

                    @empty

                        <div class="text-center py-10">
                            <div class="text-5xl mb-3">🌿</div>
                            <p class="text-gray-400">
                                No hay citas para hoy
                            </p>
                        </div>

                    @endforelse

                </div>
            </div>

        </div>

        {{-- Bottom --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">

            {{-- Estado --}}
            <div class="bg-white rounded-3xl shadow-sm p-6 border border-pink-100">

                <h2 class="text-xl font-bold text-gray-800 mb-5">
                    Estado del sistema
                </h2>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Agenda</span>
                        <span class="text-green-500 font-bold">Activa</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Calendario</span>
                        <span class="text-green-500 font-bold">Sincronizado</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Recordatorios</span>
                        <span class="text-yellow-500 font-bold">Próximo módulo</span>
                    </div>

                </div>

            </div>

            {{-- Accesos rápidos --}}
            <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm p-6 border border-sky-100">

                <h2 class="text-xl font-bold text-gray-800 mb-5">
                    Accesos rápidos
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <a href="{{ route('citas.create') }}"
                       class="p-4 rounded-2xl bg-sky-50 hover:bg-sky-100 text-center transition">
                        <div class="text-3xl mb-2">➕</div>
                        <p class="text-sm font-semibold text-gray-700">
                            Nueva cita
                        </p>
                    </a>

                    <a href="{{ route('pacientes.create') }}"
                       class="p-4 rounded-2xl bg-pink-50 hover:bg-pink-100 text-center transition">
                        <div class="text-3xl mb-2">👤</div>
                        <p class="text-sm font-semibold text-gray-700">
                            Paciente
                        </p>
                    </a>

                    <a href="{{ route('citas.calendario') }}"
                       class="p-4 rounded-2xl bg-purple-50 hover:bg-purple-100 text-center transition">
                        <div class="text-3xl mb-2">🗓️</div>
                        <p class="text-sm font-semibold text-gray-700">
                            Calendario
                        </p>
                    </a>

                    <a href="{{ route('recordatorios.index') }}"
                       class="p-4 rounded-2xl bg-yellow-50 hover:bg-yellow-100 text-center transition">
                        <div class="text-3xl mb-2">⏰</div>
                        <p class="text-sm font-semibold text-gray-700">
                            Recordatorios
                        </p>
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const dias = @json(collect($semana)->pluck('dia'));
const totales = @json(collect($semana)->pluck('total'));

new Chart(document.getElementById('graficoCitas'), {
    type: 'line',
    data: {
        labels: dias,
        datasets: [{
            data: totales,
            tension: 0.4,
            fill: true,
            borderWidth: 3,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});
</script>

</x-app-layout>