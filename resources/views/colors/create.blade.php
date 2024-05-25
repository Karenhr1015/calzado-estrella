<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Color') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('colors.store') }}" method="POST">
            @csrf
            {{-- Color --}}
            <div class="mb-5">
                <x-input-label for="color" :value="__('Color')" />
                <x-text-input id="color" class="block mt-1 w-full" name="color" :value="old('color')" autofocus
                    autocomplete="color" :placeholder="__('Ingrese un color...')" />
            </div>
            {{-- Color Validacion --}}
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
            
            {{-- Color Pickr --}}
            <div class="mb-5">
                <x-input-label for="" :value="__('Selecciona el color')" />
                <div class="color-picker block mt-1 w-full">
                </div>
                <input type="hidden" id="color_hex" name="color_hex" value="#000">
            </div>

            {{-- Btn Cancelar --}}
            <a href="{{ route('colors.index') }}">
                <x-secondary-button type="button" class="mt-4 bg-yellow-400">
                    Cancelar
                </x-secondary-button>
            </a>
            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>

    </div>
</x-app-layout>
