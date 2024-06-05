<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Temporada') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('seasons.store') }}" method="POST">
            @csrf

            {{-- Temporada --}}
            <div class="mb-5">
                <x-input-label for="name" :value="__('Temporada')" />
                <x-text-input id="name" class="block mt-1 w-full" name="name" :value="old('name')" autofocus
                    autocomplete="name" :placeholder="__('Ingrese una temporada...')" />
            </div>
            {{-- Temporada Validacion --}}
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
            {{-- Btn Cancelar --}}
            <a href="{{ route('seasons.index') }}">
                <x-cancel-button type="button" class="mt-4 text-white bg-red-800 hover:bg-red-700">
                    Cancelar
                </x-cancel-button>
            </a>

        </form>
    </div>
</x-app-layout>
