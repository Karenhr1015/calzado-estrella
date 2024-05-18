<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Color') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('colors.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="color"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Color') }}</label>
                <input type="text" name="color"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Ingrese un color...') }}" />
            </div>
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
            
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>

    </div>
</x-app-layout>
