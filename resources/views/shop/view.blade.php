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
    <div class="py-12 flex flex-wrap justify-center gap-8">
        <div class="container mx-auto p-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-50">
                <!-- First Column with Image -->
                <div class="bg-gray-200 flex items-center justify-center">
                    <div style="width: 27%" class="p-5 flex gap-5 flex-col h-[100%]">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Placeholder Image"
                            class="object-cover w-full h-full">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Placeholder Image"
                            class="object-cover w-full h-full">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Placeholder Image"
                            class="object-cover w-full h-full">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Placeholder Image"
                            class="object-cover w-full h-full">
                    </div>
                    <div style="width: 100%; height: 100%;">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Placeholder Image"
                            class="object-cover w-full h-full">
                    </div>
                </div>
                <!-- Second Column with Text -->
                <div class="bg-white p-8 flex items-center flex-col justify-evenly ml-9"
                    style="justify-content: space-evenly;">
                    <p class="text-gray-700">
                        {{-- Nombre producto --}}
                    <div style="width: 100%" class="text-2xl">
                        <strong class="text-navIcon">{{ $product->name }}</strong>
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12">
                        {{ $product->description }}
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12">
                        <strong class="text-navIcon">${{ number_format($product->price) }}</strong>
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12 flex justify-around">
                        <h1 class="text-navIcon">Tallas</h1>
                        <div>
                            <strong style="color:#809c48;">Tabla de Tallas</strong>
                        </div>
                    </div>
                    <div style="width: 55%" class="text-2xl ml-12 flex flex-col gap-5">
                        <x-select>
                            @foreach ($product->sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->value }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-primary-button class="content-center justify-center">
                            Agregar al Carrito
                        </x-primary-button>
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12 flex flex-col gap-7">
                        <strong>Colores</strong>
                        <div class="flex space-x-2">
                            @foreach ($product->colors as $color)
                                <div class="w-8 h-8 border-2 rounded-full"
                                    style="border-radius: 9999px;background-color:{{ $color->color_hex }};">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>
