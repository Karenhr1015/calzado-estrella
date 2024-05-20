<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Talla') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('sizes.store') }}" method="POST">
            @csrf

            {{-- Talla --}}
            <div class="mb-5">
                <x-input-label for="value" :value="__('Talla')" />
                <x-text-input id="value" class="block mt-1 w-full" name="value" :value="old('value')" autofocus
                    autocomplete="value" :placeholder="__('Ingrese una talla...')" />
            </div>
            {{-- Talla Validacion --}}
            <x-input-error :messages="$errors->get('value')" class="mt-2" />

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>

