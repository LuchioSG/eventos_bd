<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/reportes/eventos', [ReporteController::class, 'eventos'])->name('reportes.eventos');
Route::get('/reportes/incidencias', [ReporteController::class, 'incidencias'])->name('reportes.incidencias');