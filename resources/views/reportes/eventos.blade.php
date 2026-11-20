@extends('layouts.app')

@section('titulo', 'Reporte de eventos existentes activos e inactivos')

@section('contenido')
<div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-slate-100 text-slate-600">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Evento</th>
                <th class="px-6 py-3">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listaEventos as $e)
                <tr class="border-t">
                    <td class="px-6 py-3">{{ $e->id_evento }}</td>
                    <td class="px-6 py-3">{{ $e->nombre_evento }}</td>
                    <td class="px-6 py-3">
                        @if ($e->estado_evento)
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">Activo</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-slate-200 text-slate-600">Inactivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-4 text-slate-500">No hay eventos registrados</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection