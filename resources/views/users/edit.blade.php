<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Usuarios Administrador: {{ $user->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Nombre --}}
            <div class="mb-5">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" name="name" :value="old('name', $user->name)" autofocus
                    autocomplete="name" :placeholder="__('Ingrese un nombre...')" />
            </div>
            {{-- Nombre Validacion --}}
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            {{-- Correo --}}
            <div class="mb-5">
                <x-input-label for="email" :value="__('Correo')" />
                <x-text-input id="email" class="block mt-1 w-full" name="email" :value="old('email', $user->email)" autofocus
                    autocomplete="email" :placeholder="__('Ingrese un correo...')" />
            </div>
            {{-- Correo Validacion --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2" />


            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
            {{-- Btn Cancelar --}}
            <a href="{{ route('users.index') }}">
                <x-cancel-button type="button" class="mt-4 bg-yellow-400">
                    Cancelar
                </x-cancel-button>
            </a>
        </form>

    </div>
</x-app-layout>
