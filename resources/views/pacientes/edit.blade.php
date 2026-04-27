<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-sky-700">
            ✏️ Editar paciente
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6">
                <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('pacientes.form')

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('pacientes.index') }}"
                           class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl">
                            Cancelar
                        </a>

                        <button class="px-5 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl shadow">
                            Actualizar paciente
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>