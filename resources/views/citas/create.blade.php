<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-sky-700">
            ➕ Nueva cita
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="mb-5 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow p-6">
                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf

                    @include('citas.form')

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('citas.index') }}"
                           class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl">
                            Cancelar
                        </a>

                        <button class="px-5 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl shadow">
                            Guardar cita
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>