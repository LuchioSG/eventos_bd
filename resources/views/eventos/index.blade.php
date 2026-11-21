@extends('layouts.app')

@section('titulo', 'Gestión de eventos')

@section('contenido')
<div class="flex justify-end mb-4">
    <a href="{{ route('eventos.create') }}"
       class="bg-sky-600 hover:bg-sky-700 text-white font-semibold px-5 py-2 rounded-xl shadow">
        + Nuevo evento
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-slate-100 text-slate-600">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Evento</th>
                <th class="px-4 py-3">Hora inicio</th>
                <th class="px-4 py-3">Duración</th>
                <th class="px-4 py-3">Capacidad</th>
                <th class="px-4 py-3">Estado</th>
                <th class="px-4 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventos as $e)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $e->id_evento }}</td>
                    <td class="px-4 py-3">{{ $e->nombre_evento }}</td>
                    <td class="px-4 py-3">{{ substr($e->hora_inicio, 0, 5) }}</td>
                    <td class="px-4 py-3">{{ $e->horas }} h {{ $e->minutos }} min</td>
                    <td class="px-4 py-3">{{ number_format($e->capacidad_maxima) }}</td>
                    <td class="px-4 py-3">
                        @if ($e->estado_evento)
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">Activo</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-slate-200 text-slate-600">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('eventos.edit', $e->id_evento) }}"
                           class="px-3 py-1 rounded-lg bg-amber-100 text-amber-700 hover:bg-amber-200">Editar</a>
                        <form method="POST" action="{{ route('eventos.destroy', $e->id_evento) }}"
                              onsubmit="return confirm('¿Eliminar el evento {{ $e->id_evento }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 rounded-lg bg-rose-100 text-rose-700 hover:bg-rose-200">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection