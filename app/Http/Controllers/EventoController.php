<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    private const CAMPOS_DURACION =
        'EXTRACT(HOUR FROM duracion_evento)::int AS horas, EXTRACT(MINUTE FROM duracion_evento)::int AS minutos';

    private function reglas(bool $crear): array
    {
        $reglas = [
            'nombre_evento'    => 'required|string|max:150',
            'hora_inicio'      => 'required|date_format:H:i',
            'horas'            => 'required|integer|min:0|max:23',
            'minutos'          => 'required|integer|min:0|max:59',
            'capacidad_maxima' => 'required|integer|min:1',
        ];

        if ($crear) {
            $reglas['id_evento'] = 'required|string|max:15|unique:evento,id_evento';
        }

        return $reglas;
    }

    private function datos(Request $request): array
    {
        return [
            'nombre_evento'    => $request->nombre_evento,
            'hora_inicio'      => $request->hora_inicio,
            'duracion_evento'  => $request->horas . ' hours ' . $request->minutos . ' minutes',
            'capacidad_maxima' => $request->capacidad_maxima,
            'estado_evento'    => $request->boolean('estado_evento'),
        ];
    }

    public function index()
    {
        $eventos = DB::table('evento')
            ->selectRaw('*, ' . self::CAMPOS_DURACION)
            ->orderBy('id_evento')
            ->get();

        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->reglas(true));

        DB::table('evento')->insert(['id_evento' => $request->id_evento] + $this->datos($request));

        return redirect()->route('eventos.index')->with('exito', 'Evento creado correctamente.');
    }

    public function edit(string $id)
    {
        $evento = DB::table('evento')
            ->selectRaw('*, ' . self::CAMPOS_DURACION)
            ->where('id_evento', $id)
            ->first();

        abort_if(!$evento, 404);

        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->reglas(false));

        DB::table('evento')->where('id_evento', $id)->update($this->datos($request));

        return redirect()->route('eventos.index')->with('exito', 'Evento actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        try {
            DB::table('evento')->where('id_evento', $id)->delete();
        } catch (QueryException $e) {
            // 23503 = violación de llave foránea (el evento tiene boletos)
            if ($e->getCode() === '23503') {
                return redirect()->route('eventos.index')
                    ->with('error', "No se puede eliminar el evento $id porque tiene boletos asociados.");
            }
            throw $e;
        }

        return redirect()->route('eventos.index')->with('exito', "Evento $id eliminado correctamente.");
    }
}
