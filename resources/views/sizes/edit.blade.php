<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Talla') }} : {{ $size->value }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('sizes.update', $size->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Talla --}}
            <div class="mb-5">
                <x-input-label for="value" :value="__('Talla')" />
                <x-text-input id="value" class="block mt-1 w-full" name="value" :value="old('value', $size->value)" required autofocus
                    autocomplete="value" :placeholder="__('Ingrese una talla...')" />
            </div>
            {{-- Talla Validacion --}}
            <x-input-error :messages="$errors->get('value')" class="mt-2" />

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>

            {{-- Btn Cancelar --}}
            <a href="{{ route('sizes.index') }}">
                <x-cancel-button type="button" class="mt-4 text-white bg-red-800 hover:bg-red-700">
                    Cancelar
                </x-cancel-button>
            </a>
        </form>
    </div>
</x-app-layout>

