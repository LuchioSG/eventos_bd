@extends('layouts.app')

@section('titulo', 'Reporte de incidencias registradas por nivel de gravedad')

@section('contenido')
<div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-slate-100 text-slate-600">
            <tr>
                <th class="px-6 py-3">Evento</th>
                <th class="px-6 py-3">Incidencia</th>
                <th class="px-6 py-3">Descripción</th>
                <th class="px-6 py-3">Gravedad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incidencias as $inc)
                @php
                    $color = match ($inc->nivel_gravedad) {
                        'bajo'     => 'bg-emerald-100 text-emerald-700',
                        'medio'    => 'bg-amber-100 text-amber-700',
                        'alto'     => 'bg-orange-100 text-orange-700',
                        'muy alto' => 'bg-rose-100 text-rose-700',
                        default    => 'bg-slate-100 text-slate-700',
                    };
                @endphp
                <tr class="border-t">
                    <td class="px-6 py-3">{{ $inc->id_evento }}</td>
                    <td class="px-6 py-3">{{ $inc->id_incidencia }}</td>
                    <td class="px-6 py-3">{{ $inc->descripcion }}</td>
                    <td class="px-6 py-3">
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                            {{ ucfirst($inc->nivel_gravedad ?? 'Sin clasificar') }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-4 text-slate-500">No hay incidencias registradas</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection