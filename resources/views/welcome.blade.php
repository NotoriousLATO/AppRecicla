@extends('layouts.app')

@section('head')
    @include('partials.welcome-styles')
@endsection

@section('content')
    <div class="container">
        <!-- Logo -->
        
        <div class="logo">
            <img src="{{ asset('images/logory.png') }}" alt="Logo">
        </div>

        <!-- Título -->
        <div class="title">🌱 Bienvenido a ReciclaYa: Transformando el futuro, un reciclaje a la vez ♻️</div>
        <div class="subtitle">En esta app, cada acción cuenta. Aprende, recicla y gana dinero mientras cuidas del planeta. Juntos, convertimos tus desechos en oportunidades para un mundo más verde. 💚
                                    ¡Empieza ahora y sé parte del cambio! 🌍✨</div>

        <!-- Botones -->
        <div class="buttons">
            <a href="{{ route('login') }}">Iniciar Sesión</a>
            <a href="{{ route('register') }}">Registrarse</a>
        </div>
    </div>
@endsection
