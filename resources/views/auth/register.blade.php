@extends('skeleton')

@section('content')
<x-auth-card>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current" />
        </a>
    </x-slot>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Store Name -->
        <div>
            <x-label for="storeName" value="Nombre de la tienda" />
            <x-input id="storeName" class="block w-full" type="text" name="storeName" :value="old('storeName')" required autofocus />
        </div>

        <!-- Store Path -->
        <div x-data="{ storePath: '{{ old('storePath') }}' }">
            <label class="label">
                <span class="label-text">Direccion de la tienda</span>
                <span class="label-text-alt" x-text="'store.smn947.com.co/' + storePath">store.smn947.com.co/</span>
            </label>
            <x-input x-model="storePath" id="storePath" class="block w-full" type="text" name="storePath" x-on:input="sanitizeInput" required />
        </div>

        <!-- Name -->
        <div>
            <x-label for="name" value="Nombre Usuario" />
            <x-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" value="Correo" />
            <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" value="Contraseña" />
            <x-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" value="Confirmar Contraseña" />
            <x-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm link" href="{{ route('login') }}">
                Ya tienes cuenta?
            </a>

            <x-button class="ml-4">
                Registrarse
            </x-button>
        </div>
    </form>
</x-auth-card>
<script>
    function sanitizeInput() {
        this.storePath = this.storePath
            .replace(/[^\w\s]/gi, '') // Remove special characters
            .replace(/\s+/g, '_') // Replace spaces with underscores
            .replace(/[áàãâä]/gi, 'a') // Replace accent letters with non-accented equivalents
            .replace(/[éèêë]/gi, 'e')
            .replace(/[íìîï]/gi, 'i')
            .replace(/[óòõôö]/gi, 'o')
            .replace(/[úùûü]/gi, 'u')
            .replace(/[ç]/gi, 'c'); // Replace cedilla (ç) with 'c'
        // Add more replacements as needed for specific characters or patterns
    }
</script>
@endsection