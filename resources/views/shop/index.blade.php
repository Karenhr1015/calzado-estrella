<x-shop-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <div
                class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-around bg-[#D5C4D7] text-[#080640]">
                {{-- <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Temporada') }}
                </div> --}}
                <form class="flex items-center" action="{{ route('raiz') }}" method="GET">
                    <input type="hidden" name="woman">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-primary-button class="bg-purple-100 text-black hover:bg-purple-50 ">
                            {{ __('Mujer') }}
                        </x-primary-button>
                    </div>
                </form>
                <form class="flex items-center" action="{{ route('raiz') }}" method="GET">
                    <input type="hidden" name="men">
                    <x-primary-button class="bg-purple-100 text-black hover:bg-purple-50 ">
                        {{ __('Hombre') }}
                    </x-primary-button>
                </form>
                <form class="flex items-center" action="{{ route('raiz') }}" method="GET">
                    <input type="hidden" name="boys">
                    <x-primary-button class="bg-purple-100 text-black hover:bg-purple-50 ">
                        {{ __('Niños') }}
                    </x-primary-button>
                </form>
                <form class="flex items-center" action="{{ route('raiz') }}" method="GET">
                    <input type="hidden" name="girls">
                    <x-primary-button class="bg-purple-100 text-black hover:bg-purple-50 ">
                        {{ __('Niñas') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
    @if (!$isWoman)
        {{-- Carrusel --}}
        <x-carousel></x-carousel>
    @endif
    {{-- Products --}}
    <div class="py-12 flex flex-wrap justify-center gap-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <a href="{{ route('shop.view', $product) }}" class="flex justify-center items-center p-4">
                            <img class="rounded-t-lg" style="max-height: 350px"
                                src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('img/avatars/avatar_default.png') }}"
                                alt="" />
                        </a>
                        <div class="flex flex-col flex-grow p-5">
                            <div>
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $product->name }} - {{ $product->product_type->name }} </h5>
                            </div>
                            <div class="flex space-x-2 mb-3">
                                <h2>Colores</h2>
                                @foreach ($product->colors as $color)
                                    <div class="w-6 h-6 border-2 border-black-200"
                                        style="background-color:{{ $color->color_hex }};"></div>
                                @endforeach
                            </div>
                            <div class="flex space-x-2 mb-3">
                                <h2>Tallas</h2>
                                @foreach ($product->sizes as $size)
                                    <div class="w-6 h-6 text-xl">{{ $size->value }}</div>
                                @endforeach
                            </div>
                            @auth
                                @if ($user->role_id == 3)
                                    <div>
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            Precio mayorista: {{ number_format($product->wholesale_price) }} </h5>
                                    </div>
                                @else
                                    <div>
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            Precio: {{ number_format($product->price) }} </h5>
                                    </div>
                                @endif
                            @else
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Precio: {{ number_format($product->price) }} </h5>
                                </div>
                            @endauth

                            <br>
                            {{--  <div class="mt-auto">
                                <button type="button"
                                    class="add-to-cart inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    data-id="{{ $product->id }}">
                                    Añadir al carrito
                                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        class="rtl:rotate-180 w-3.5 h-3.5 ms-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                    </svg>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-shop-layout>
