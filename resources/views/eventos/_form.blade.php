@php $esEdicion = isset($evento); @endphp

@if ($errors->any())
    <div class="bg-rose-100 text-rose-700 rounded-xl p-4 mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-5">
    <div>
        <label class="block text-slate-600 mb-1">ID del evento</label>
        <input type="text" name="id_evento" maxlength="15"
               value="{{ old('id_evento', $evento->id_evento ?? '') }}"
               {{ $esEdicion ? 'readonly' : 'required' }}
               class="w-full border rounded-xl px-4 py-2 {{ $esEdicion ? 'bg-slate-100 text-slate-500' : '' }}">
    </div>

    <div>
        <label class="block text-slate-600 mb-1">Nombre del evento</label>
        <input type="text" name="nombre_evento" required
               value="{{ old('nombre_evento', $evento->nombre_evento ?? '') }}"
               class="w-full border rounded-xl px-4 py-2">
    </div>

    <div>
        <label class="block text-slate-600 mb-1">Hora de inicio</label>
        <input type="time" name="hora_inicio" required
               value="{{ old('hora_inicio', isset($evento) ? substr($evento->hora_inicio, 0, 5) : '') }}"
               class="w-full border rounded-xl px-4 py-2">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-slate-600 mb-1">Duración (horas)</label>
            <input type="number" name="horas" min="0" max="23" required
                   value="{{ old('horas', $evento->horas ?? 0) }}"
                   class="w-full border rounded-xl px-4 py-2">
        </div>
        <div>
            <label class="block text-slate-600 mb-1">Duración (minutos)</label>
            <input type="number" name="minutos" min="0" max="59" required
                   value="{{ old('minutos', $evento->minutos ?? 0) }}"
                   class="w-full border rounded-xl px-4 py-2">
        </div>
    </div>

    <div>
        <label class="block text-slate-600 mb-1">Capacidad máxima</label>
        <input type="number" name="capacidad_maxima" min="1" required
               value="{{ old('capacidad_maxima', $evento->capacidad_maxima ?? '') }}"
               class="w-full border rounded-xl px-4 py-2">
    </div>

    <label class="flex items-center gap-3 text-slate-600">
        <input type="hidden" name="estado_evento" value="0">
        <input type="checkbox" name="estado_evento" value="1" class="w-5 h-5"
               @checked(old('estado_evento', $evento->estado_evento ?? true))>
        Evento activo
    </label>

    <div class="flex gap-3 justify-end">
        <a href="{{ route('eventos.index') }}" class="px-5 py-2 rounded-xl bg-slate-200 text-slate-700">Cancelar</a>
        <button class="px-5 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold">Guardar</button>
    </div>
</div>