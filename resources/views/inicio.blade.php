<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo de incidencias en eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-50 min-h-screen">
<main class="min-h-screen flex flex-col justify-center gap-10 px-10 py-8">

    <h1 class="text-6xl md:text-7xl font-extrabold text-slate-800 text-center leading-tight">
        Sistema de monitoreo de incidencias<br>en eventos sociales
    </h1>

    <h2 class="text-3xl font-mono font-semibold text-slate-800 dark:text-slate-500 text-center tracking-tight">
        Te damos la bienvenida a nuestra pagina de control de incidencias<br>de nuestros eventos afiliados
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl w-full mx-auto">
        <img src="{{ asset('img/concierto.jpg') }}" class="rounded-2xl h-56 w-full object-cover shadow">
        <img src="{{ asset('img/comiccon.jpg') }}" class="rounded-2xl h-56 w-full object-cover shadow">
        <img src="{{ asset('img/seguridad.jpg') }}" class="rounded-2xl h-56 w-full object-cover shadow">
    </div>

    <section class="max-w-4xl w-full mx-auto bg-white rounded-3xl shadow-lg p-8 text-center">
        <p class="text-xl text-slate-500">Evento con más incidencias registradas</p>
        <p class="text-4xl font-bold text-rose-600 mt-2">
            {{ $eventoTop->nombre_evento ?? 'Sin incidencias registradas' }}
        </p>
        <p class="text-2xl text-slate-600 mt-1">
            {{ $eventoTop->total_incidencias ?? 0 }} incidencias
        </p>
        <div class="mt-6 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 border-b">
                        <th class="py-2 pr-4">Hora</th>
                        <th class="py-2 pr-4">Descripción</th>
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
                        <tr class="border-b last:border-0">
                            <td class="py-2 pr-4">{{ \Carbon\Carbon::parse($inc->hora_incidencia)->format('H:i') }}</td>
                            <td class="py-2 pr-4">{{ $inc->descripcion }}</td>
                            <td class="py-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                                    {{ ucfirst($inc->nivel_gravedad) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-4 text-slate-500">Sin incidencias registradas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl w-full mx-auto">
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <p class="text-4xl font-bold text-emerald-600">{{ $eventosActivos }}</p>
            <p class="text-slate-500">Eventos activos</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <p class="text-4xl font-bold text-amber-600">{{ $totalIncidencias }}</p>
            <p class="text-slate-500">Incidencias totales registradas</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center">
            <p class="text-4xl font-bold text-sky-600">{{ $boletosVendidos }}</p>
            <p class="text-slate-500">Boletos vendidos</p>
        </div>
    </div>

</main>
</body>
</html>