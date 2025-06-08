@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Panel de administración</h1>
    <p class="mt-2">Bienvenido, administrador.</p>
    <p>usuarios:</p>
    @include('admin.users', ['users' => $users])
@endsection
