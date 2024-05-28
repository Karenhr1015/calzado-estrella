<x-app-layout>
    {{-- Cabecera --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Producto: ({{ $product->code }}) {{ $product->name }}   <x-status :type="$product->status"></x-status>
        </h2>
    </x-slot>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xxl px-4 lg:px-12">
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Imagen del producto --}}
                    <div class="flex justify-center p-4">
                        <img src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('img/avatars/avatar_default.png') }}"
                            alt="{{ $product->name }}" class="w-full h-auto max-w-md w-50 h-50">
                    </div>
                    {{-- Información del producto --}}
                    <div>
                        <h1 class="text-3xl font-bold mb-4">({{ $product->code }}) {{ $product->name }}</h1>
                        <p class="text-lg mb-2">{{ $product->description }}</p>

                        {{-- Precios --}}
                        <div>
                            <h2 class="text-3xl font-bold mb-4">Cantidad</h2>
                            <p class="text-xl font-semibold text-purple-800 mb-4">{{ number_format($product->amount) }}
                            </p>
                            <h2 class="text-3xl font-bold mb-4">Precio</h2>
                            <p class="text-xl font-semibold text-green-700 mb-4">${{ number_format($product->price) }}
                            </p>
                            <h2 class="text-3xl font-bold mb-4">Precio Mayorista</h2>
                            <p class="text-xl font-semibold text-green-700 mb-4">
                                ${{ number_format($product->wholesale_price) }}</p>
                        </div>

                        {{-- Colores --}}
                        <div class="p-4">
                            <h2 class="text-3xl font-bold mb-4">Colores</h2>
                            <div class="flex space-x-2">
                                @foreach ($product->colors as $color)
                                    <div class="w-6 h-6 border-2 border-black-200"
                                        style="background-color:{{ $color->color_hex }};"></div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Tallas --}}
                        <div class="p-4">
                            <h2 class="text-3xl font-bold mb-4">Tallas</h2>
                            <div class="flex space-x-2">
                                @foreach ($product->sizes as $size)
                                    <div class="w-10 h-10 border-2-black-200 text-lg">
                                        <strong>{{ $size->value }}</strong>
                                    </div> |
                                @endforeach
                            </div>
                        </div>

                        {{-- Información adicional del producto --}}
                        <ul class="list-disc list-inside">
                            <li class="text-lg"><strong>Tipo de producto:</strong> {{ $product->product_type->name }}
                            </li>
                            <li class="text-lg"><strong>Fecha de creacion:</strong> {{ $product->created_at }} |
                                {{ $product->created_at->diffForHumans() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
