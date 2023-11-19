@extends('skeleton')

@section('content')
<x-auth-card>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current" />
        </a>
    </x-slot>

    <div class="mb-4 text-sm">
        {{ __('Si olvidaste tu contraseña, solo ingresa tu correo y te enviaremos un enlace para cambiarla.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ __('Enviar enlace de recuperacion') }}
            </x-button>
        </div>
    </form>
</x-auth-card>
@endsection