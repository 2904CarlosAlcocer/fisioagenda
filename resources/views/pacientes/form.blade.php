<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    {{-- Nombre --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Nombre completo *
        </label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre', $paciente->nombre ?? '') }}"
               placeholder="Ejemplo: María González"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('nombre')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Teléfono --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Teléfono *
        </label>

        <input type="text"
               name="telefono"
               value="{{ old('telefono', $paciente->telefono ?? '') }}"
               placeholder="Ejemplo: 8888-8888"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('telefono')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Cédula --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Cédula
        </label>

        <input type="text"
               name="cedula"
               value="{{ old('cedula', $paciente->cedula ?? '') }}"
               placeholder="Ejemplo: 1-1111-1111"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
    </div>

    {{-- Edad --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Edad
        </label>

        <input type="number"
               name="edad"
               value="{{ old('edad', $paciente->edad ?? '') }}"
               placeholder="Ejemplo: 35"
               min="0"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
    </div>

    {{-- Correo --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Correo
        </label>

        <input type="email"
               name="correo"
               value="{{ old('correo', $paciente->correo ?? '') }}"
               placeholder="correo@ejemplo.com"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
    </div>

    {{-- Estado --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Estado *
        </label>

        <select name="estado"
                class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="activo" {{ old('estado', $paciente->estado ?? 'activo') === 'activo' ? 'selected' : '' }}>
                Activo
            </option>

            <option value="inactivo" {{ old('estado', $paciente->estado ?? '') === 'inactivo' ? 'selected' : '' }}>
                Inactivo
            </option>

        </select>
    </div>

    {{-- Dirección --}}
    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">
            Dirección
        </label>

        <textarea name="direccion"
                  rows="2"
                  placeholder="Provincia, cantón, distrito o señas importantes..."
                  class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">{{ old('direccion', $paciente->direccion ?? '') }}</textarea>
    </div>

    {{-- Motivo --}}
    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">
            Motivo principal de visita
        </label>

        <textarea name="motivo_visita"
                  rows="3"
                  placeholder="Ejemplo: dolor en fascia plantar, tendinitis, rehabilitación de rodilla..."
                  class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">{{ old('motivo_visita', $paciente->motivo_visita ?? '') }}</textarea>
    </div>

    {{-- Observaciones --}}
    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">
            Observaciones importantes
        </label>

        <textarea name="observaciones"
                  rows="3"
                  placeholder="Notas importantes para recordar antes de atender al paciente..."
                  class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">{{ old('observaciones', $paciente->observaciones ?? '') }}</textarea>
    </div>

</div>