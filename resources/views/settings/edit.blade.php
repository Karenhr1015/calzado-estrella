<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar configuracion') }} : {{ $setting->key }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('settings.update', $setting->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Tipo de producto --}}
            <div class="mb-5">
                <x-input-label for="value" :value="__('Temporada activa')" />
                <x-select id="value" name="value">
                    <option value=""></option>
                    @foreach ($seasons as $season)
                        <option value="{{ $season->id }}"
                            {{ $season->id == old('value') ? 'selected' : '' }}>
                            {{ $season->name }}</option>
                    @endforeach
                </x-select>
                {{-- Tipo de producto Validacion --}}
                <x-input-error :messages="$errors->get('value')" class="mt-2" />
            </div>

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>

            {{-- Boton cancelar --}}
            <a href="{{ route('settings.index') }}">
                <x-cancel-button type="button" class="mt-4 text-white bg-red-800 hover:bg-red-700">
                    Cancelar
                </x-cancel-button>
            </a>
        </form>
    </div>
</x-app-layout>
