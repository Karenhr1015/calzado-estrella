<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Color') }} : {{ $color->color }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('colors.update', $color->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Color --}}
            <div class="mb-5">
                <x-input-label for="color" :value="__('Color')" />
                <x-text-input id="color" class="block mt-1 w-full" name="color" :value="old('color', $color->color)" required autofocus
                    autocomplete="color" :placeholder="__('Ingrese un color...')" />
            </div>
            {{-- Color Validacion --}}
            <x-input-error :messages="$errors->get('color')" class="mt-2" />

            {{-- Color Pickr --}}
            <div class="mb-5">
                <x-input-label for="" :value="__('Color Anterior')" />
                <div id="color-preview" class="w-9 h-9" style="background-color: {{ $color->color_hex ?? '#FFFFFF' }}">
                </div>
                <br>
                <x-input-label for="" :value="__('Selecciona el nuevo color')" />
                <div class="color-picker block mt-1 w-full"
                    style="background-color: {{ $color->color_hex ?? '#FFFFFF' }}">
                </div>
                <input type="hidden" id="color_hex" name="color_hex" value="{{ $color->color_hex }}">
            </div>

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
