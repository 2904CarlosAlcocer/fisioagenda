<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    <div>
        <label class="block text-gray-700 font-semibold mb-2">Usuario *</label>

        <select name="user_id"
                class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
            <option value="">Seleccione usuario</option>

            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}"
                    {{ old('user_id', $fisioterapeuta->user_id ?? '') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->name }} - {{ $usuario->email }}
                </option>
            @endforeach
        </select>

        @error('user_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2">Especialidad</label>

        <input type="text"
               name="especialidad"
               value="{{ old('especialidad', $fisioterapeuta->especialidad ?? '') }}"
               placeholder="Ejemplo: Terapia deportiva"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('especialidad')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>

        <input type="text"
               name="telefono"
               value="{{ old('telefono', $fisioterapeuta->telefono ?? '') }}"
               placeholder="Ejemplo: 8888-8888"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('telefono')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2">Estado *</label>

        @php
            $estado = old('estado', $fisioterapeuta->estado ?? 'activo');
        @endphp

        <select name="estado"
                class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
            <option value="activo" {{ $estado == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>

        @error('estado')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-2">Horario</label>

        <input type="text"
               name="horario"
               value="{{ old('horario', $fisioterapeuta->horario ?? '') }}"
               placeholder="Ejemplo: Lunes a viernes, 7:00 AM - 5:00 PM"
               class="w-full rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">

        @error('horario')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>