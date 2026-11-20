<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') | Monitoreo de incidencias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-50 min-h-screen">
    <nav class="bg-white shadow px-8 py-4 flex gap-6 text-lg">
        <a href="{{ route('inicio') }}" class="font-semibold text-slate-800 hover:text-sky-600">Inicio</a>
        <a href="{{ route('reportes.eventos') }}" class="text-slate-600 hover:text-sky-600">Reporte de eventos</a>
        <a href="{{ route('reportes.incidencias') }}" class="text-slate-600 hover:text-sky-600">Reporte de incidencias</a>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-5xl font-extrabold text-slate-800 text-center mb-10">@yield('titulo')</h1>
        @yield('contenido')
    </main>
</body>
</html>