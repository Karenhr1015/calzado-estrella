<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Producto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-4xl mx-auto" action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-5">
                    <label for="code"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Codigo') }}</label>
                    <input type="text" name="code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Ingrese el codigo...') }}" required />
                </div>

                <div class="mb-5">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Referencia') }}</label>
                    <input type="text" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Ingrese la referencia...') }}" required />
                </div>

                <div class="mb-5">
                    <x-input-label for="color_id" :value="__('Color')"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                    <select id="color_id" name="color_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->color }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <x-input-label for="size_id" :value="__('Talla')"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                    <select id="size_id" name="size_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <x-input-label for="season_id" :value="__('Temporada')"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                    <select id="season_id" name="season_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($seasons as $season)
                            <option value="{{ $season->id }}">{{ $season->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="price"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Precio') }}</label>
                    <input type="text" name="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Ingrese el precio...') }}" required />
                </div>
            </div>
            <x-primary-button type="submit" class="mt-4">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
