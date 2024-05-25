<x-shop-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div
                class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-around bg-[#D5C4D7] text-[#080640]">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Temporada') }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Mujer') }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Hombre') }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Niños') }}
                </div>
            </div>
        </div>
    </div>
    {{-- Carrusel --}}
    <x-carousel></x-carousel>
    {{-- Products --}}
    <div class="py-12 flex flex-wrap justify-center gap-8">
        @foreach ($products as $product)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('shop.view', $product) }}" class="flex justify-center items-center p-4">
                        <img class="rounded-t-lg" src="{{ asset('storage/' . $product->photo) }}" alt=""
                            class="w-150 h-150" />
                    </a>
                    <div class="p-5">
                        <a href="#" class="">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $product->name }} - {{ $product->product_type->name }} </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Talla:
                            Temporada:
                            {{ $product->season->name }}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <div class="flex space-x-2">
                            <h2>Colores</h2>
                            @foreach ($product->colors as $color)
                                <div class="w-6 h-6 border-2 border-black-200"
                                    style="background-color:{{ $color->color_hex }};"></div>
                            @endforeach
                        </div>
                        <br>
                        <div class="flex space-x-2">
                            <h2>Tallas</h2>
                            @foreach ($product->sizes as $size)
                                <div class="w-6 h-6 text-xl">{{ $size->value }}</div>
                            @endforeach
                        </div>
                        </p>
                        <br>
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            ${{ $product->price }} | Precio mayorista: {{ $product->wholesale_price }}
                            </p>
                            <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                class="rtl:rotate-180 w-3.5 h-3.5 ms-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                        </button>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-shop-layout>
