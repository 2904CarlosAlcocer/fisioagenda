<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    {{-- Paciente --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Paciente *
        </label>

        <select name="paciente_id"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="">Seleccione un paciente</option>

            @foreach($pacientes as $paciente)
                <option value="{{ $paciente->id }}"
                    {{ old('paciente_id', $cita->paciente_id ?? '') == $paciente->id ? 'selected' : '' }}>
                    {{ $paciente->nombre }} - {{ $paciente->telefono }}
                </option>
            @endforeach

        </select>

        @error('paciente_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Fisioterapeuta --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Fisioterapeuta *
        </label>

        <select name="fisioterapeuta_id"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="">Seleccione fisioterapeuta</option>

            @foreach($fisioterapeutas as $fisio)
                <option value="{{ $fisio->id }}"
                    {{ old('fisioterapeuta_id', $cita->fisioterapeuta_id ?? '') == $fisio->id ? 'selected' : '' }}>
                    {{ $fisio->user->name }}
                </option>
            @endforeach

        </select>

        @error('fisioterapeuta_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Sala --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Sala *
        </label>

        <select name="sala_id"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="">Seleccione una sala</option>

            @foreach($salas as $sala)
                <option value="{{ $sala->id }}"
                    {{ old('sala_id', $cita->sala_id ?? '') == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nombre }}
                </option>
            @endforeach

        </select>

        @error('sala_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Estado --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Estado *
        </label>

        @php
            $estadoActual = old('estado', $cita->estado ?? 'pendiente');
        @endphp

        <select name="estado"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="pendiente" {{ $estadoActual == 'pendiente' ? 'selected' : '' }}>
                Pendiente
            </option>

            <option value="confirmada" {{ $estadoActual == 'confirmada' ? 'selected' : '' }}>
                Confirmada
            </option>

            <option value="atendida" {{ $estadoActual == 'atendida' ? 'selected' : '' }}>
                Atendida
            </option>

            <option value="cancelada" {{ $estadoActual == 'cancelada' ? 'selected' : '' }}>
                Cancelada
            </option>

        </select>
    </div>


    {{-- Fecha --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Fecha *
        </label>

        <input type="date"
            name="fecha"
            value="{{ old('fecha', $cita->fecha ?? $fecha ?? '') }}"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('fecha')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Hora Inicio --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Hora *
        </label>

        <select name="hora_inicio"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="">Seleccione hora</option>

            @foreach([
                '07:00','08:00','09:00','10:00',
                '11:00','12:00','13:00','14:00',
                '15:00','16:00','17:00'
            ] as $hora)

                <option value="{{ $hora }}"
                    {{ old('hora_inicio', isset($cita) ? substr($cita->hora_inicio,0,5) : ($hora_inicio ?? '')) == $hora ? 'selected' : '' }}>
                    {{ $hora }}
                </option>

            @endforeach

        </select>

        @error('hora_inicio')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Motivo --}}
    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">
            Motivo de la cita *
        </label>

        <textarea name="motivo"
            rows="3"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400"
            placeholder="Ejemplo: dolor lumbar, fascia plantar, rodilla, hombro...">{{ old('motivo', $cita->motivo ?? '') }}</textarea>

        @error('motivo')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Observaciones --}}
    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">
            Observaciones
        </label>

        <textarea name="observaciones"
            rows="3"
            class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400"
            placeholder="Notas importantes...">{{ old('observaciones', $cita->observaciones ?? '') }}</textarea>
    </div>

</div>