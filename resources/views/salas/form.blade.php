<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    {{-- Nombre --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Nombre de sala *
        </label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre', $sala->nombre ?? '') }}"
               placeholder="Ejemplo: Sala 1"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('nombre')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Ubicación --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Ubicación
        </label>

        <input type="text"
               name="ubicacion"
               value="{{ old('ubicacion', $sala->ubicacion ?? '') }}"
               placeholder="Ejemplo: Primer piso"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('ubicacion')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Capacidad --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Capacidad
        </label>

        <input type="number"
               min="1"
               name="capacidad"
               value="{{ old('capacidad', $sala->capacidad ?? '') }}"
               placeholder="Ejemplo: 2"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('capacidad')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Estado --}}
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Estado *
        </label>

        @php
            $estado = old('estado', $sala->estado ?? 'disponible');
        @endphp

        <select name="estado"
                class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

            <option value="disponible" {{ $estado == 'disponible' ? 'selected' : '' }}>
                Disponible
            </option>

            <option value="ocupada" {{ $estado == 'ocupada' ? 'selected' : '' }}>
                Ocupada
            </option>

            <option value="mantenimiento" {{ $estado == 'mantenimiento' ? 'selected' : '' }}>
                Mantenimiento
            </option>

        </select>
    </div>

    {{-- Descripción --}}
    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">
            Descripción
        </label>

        <textarea name="descripcion"
                  rows="4"
                  placeholder="Detalles de la sala, equipos, camilla, accesorios..."
                  class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">{{ old('descripcion', $sala->descripcion ?? '') }}</textarea>

        @error('descripcion')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>