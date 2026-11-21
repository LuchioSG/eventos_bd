@extends('layouts.app')

@section('titulo', 'Registrar nuevo evento')

@section('contenido')
<form method="POST" action="{{ route('eventos.store') }}"
      class="bg-white rounded-2xl shadow p-8 max-w-2xl mx-auto">
    @csrf
    @include('eventos._form')
</form>
@endsection