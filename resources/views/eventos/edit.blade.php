@extends('layouts.app')

@section('titulo', 'Editar evento')

@section('contenido')
<form method="POST" action="{{ route('eventos.update', $evento->id_evento) }}"
      class="bg-white rounded-2xl shadow p-8 max-w-2xl mx-auto">
    @csrf
    @method('PUT')
    @include('eventos._form')
</form>
@endsection