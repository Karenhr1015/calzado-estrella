<x-app-layout>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{route('seasons.store')}}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="color"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Temporada') }}</label>
                <input type="text" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Ingrese el nombre...') }}" required />
            </div>
            <x-primary-button type="submit">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>

    </div>
</x-app-layout>
