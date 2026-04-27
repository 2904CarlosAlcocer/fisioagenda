<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-sky-700">
            🧾 Detalle del paciente
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-sky-700">
                            {{ $paciente->nombre }}
                        </h1>

                        <p class="text-gray-500">
                            Teléfono: {{ $paciente->telefono }}
                        </p>
                    </div>

                    <a href="{{ route('pacientes.edit', $paciente) }}"
                       class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl">
                        Editar
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="bg-sky-50 p-4 rounded-xl">
                        <p class="text-gray-500">Cédula</p>
                        <p class="font-bold">{{ $paciente->cedula ?? 'No registrada' }}</p>
                    </div>

                    <div class="bg-sky-50 p-4 rounded-xl">
                        <p class="text-gray-500">Edad</p>
                        <p class="font-bold">{{ $paciente->edad ?? 'No registrada' }}</p>
                    </div>

                    <div class="bg-sky-50 p-4 rounded-xl">
                        <p class="text-gray-500">Correo</p>
                        <p class="font-bold">{{ $paciente->correo ?? 'No registrado' }}</p>
                    </div>

                    <div class="bg-sky-50 p-4 rounded-xl">
                        <p class="text-gray-500">Estado</p>
                        <p class="font-bold capitalize">{{ $paciente->estado }}</p>
                    </div>

                    <div class="md:col-span-2 bg-green-50 p-4 rounded-xl">
                        <p class="text-gray-500">Motivo principal de visita</p>
                        <p class="font-semibold text-gray-700">
                            {{ $paciente->motivo_visita ?? 'Sin motivo registrado' }}
                        </p>
                    </div>

                    <div class="md:col-span-2 bg-blue-50 p-4 rounded-xl">
                        <p class="text-gray-500">Observaciones</p>
                        <p class="font-semibold text-gray-700">
                            {{ $paciente->observaciones ?? 'Sin observaciones' }}
                        </p>
                    </div>

                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-xl">
                        <p class="text-gray-500">Dirección</p>
                        <p class="font-semibold text-gray-700">
                            {{ $paciente->direccion ?? 'Sin dirección registrada' }}
                        </p>
                    </div>

                </div>

                <div class="mt-6">
                    <a href="{{ route('pacientes.index') }}"
                       class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>