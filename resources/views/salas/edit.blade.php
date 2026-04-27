<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            ✏️ Editar Sala
        </h2>
    </x-slot>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-3 sm:px-6">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <form action="{{ route('salas.update', $sala) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('salas.form')

                    <div class="mt-6 flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <a href="{{ route('salas.index') }}"
                           class="w-full sm:w-auto text-center px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold">
                            Cancelar
                        </a>

                        <button class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gradient-to-r from-pink-500 to-purple-500 text-white shadow font-semibold">
                            Actualizar Sala
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>