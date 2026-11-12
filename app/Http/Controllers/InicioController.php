<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index()
    {
        // Dato principal: evento con más incidencias
        $eventoTop = DB::table('evento_incidencia as ei')
            ->join('evento as e', 'e.id_evento', '=', 'ei.id_evento')
            ->select('e.id_evento', 'e.nombre_evento', DB::raw('COUNT(*) as total_incidencias'))
            ->groupBy('e.id_evento', 'e.nombre_evento')
            ->orderByDesc('total_incidencias')
            ->orderBy('e.nombre_evento') // desempate
            ->first();

        $incidencias = $eventoTop
            ? DB::table('evento_incidencia as ei')
                ->join('incidencia as i', 'i.id_incidencia', '=', 'ei.id_incidencia')
                ->where('ei.id_evento', $eventoTop->id_evento)
                ->select(
                    'i.id_incidencia',
                    'i.descripcion',
                    'i.nivel_gravedad',
                    'ei.hora_incidencia'
                )
                ->orderBy('ei.hora_incidencia')
                ->get()
            : collect();

        // Tarjetas extra
        $eventosActivos   = DB::table('evento')->where('estado_evento', true)->count();
        $totalIncidencias = DB::table('evento_incidencia')->count();
        $boletosVendidos  = DB::table('boleto')->count();

        return view('inicio', compact(
            'eventoTop', 'incidencias', 'eventosActivos', 'totalIncidencias', 'boletosVendidos'
        ));
    }
}
