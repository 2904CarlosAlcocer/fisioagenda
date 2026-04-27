<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-sky-50 py-6 sm:py-8">
    <div class="max-w-4xl mx-auto px-3 sm:px-6">

        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Nuevo Recordatorio
            </h1>
            <p class="text-gray-500 mt-2 text-sm sm:text-base">
                Programa un aviso para una cita
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm p-4 sm:p-8 border border-purple-100">
            <form action="{{ route('recordatorios.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Cita *
                    </label>

                    <select name="cita_id"
                            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
                        <option value="">Seleccione una cita</option>

                        @foreach($citas as $cita)
                            <option value="{{ $cita->id }}" {{ old('cita_id') == $cita->id ? 'selected' : '' }}>
                                {{ $cita->paciente->nombre ?? 'Sin paciente' }}
                                — {{ $cita->fecha }}
                                {{ substr($cita->hora_inicio, 0, 5) }}
                            </option>
                        @endforeach
                    </select>

                    @error('cita_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Fecha y hora del recordatorio *
                    </label>

                    <input type="datetime-local"
                           name="fecha_recordatorio"
                           value="{{ old('fecha_recordatorio') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

                    @error('fecha_recordatorio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Mensaje *
                    </label>

                    <textarea name="mensaje"
                              rows="5"
                              class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400"
                              placeholder="Hola, le recordamos su cita en FisioAgenda Pro...">{{ old('mensaje') }}</textarea>

                    @error('mensaje')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                    <a href="{{ route('recordatorios.index') }}"
                       class="w-full sm:w-auto text-center px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gradient-to-r from-pink-500 to-purple-500 text-white shadow-lg font-semibold">
                        Guardar recordatorio
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
</x-app-layout>