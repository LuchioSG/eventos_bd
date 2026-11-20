<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    // Reporte 1
    public function eventos()
    {
        $listaEventos = DB:: table('evento')
        ->select('id_evento', 'nombre_evento', 'estado_evento')
        ->orderBy('id_evento')
        ->get();

        return view('reportes.eventos', compact('listaEventos'));
        
    }

    // Reporte 2

    public function incidencias()
    {
        $incidencias = DB::table('evento_incidencia as ei')
            ->leftJoin('incidencia as i', 'ei.id_incidencia', '=', 'i.id_incidencia')
            ->select('ei.id_evento', 'ei.id_incidencia', 'i.descripcion', 'i.nivel_gravedad')
            ->orderByRaw("ARRAY_POSITION(ARRAY['bajo','medio','alto','muy alto'], i.nivel_gravedad)")
            ->orderBy('ei.id_evento')
            ->orderBy('ei.id_incidencia')
            ->get();

        return view('reportes.incidencias', compact('incidencias'));

    }
}
