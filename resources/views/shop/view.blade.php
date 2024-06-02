<x-shop-layout>
    {{-- Filtros --}}
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

    {{-- Contenido --}}
    <div class="py-12 flex flex-wrap justify-center gap-8">
        <div class="container mx-auto p-2">
            {{-- Imagenes --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-64">
                <div class="bg-gray-100 p-4 shadow rounded flex items-center justify-center" style="height: 600px;">
                    {{-- Imagenes por color --}}
                    <div style="width: 27%" class="p-5 flex gap-5 flex-col h-[100%] overflow-auto custom-scroll">
                        @foreach ($product->colors as $color)
                            @if ($color->pivot->img_path)
                                <img src="{{ asset('storage/' . $color->pivot->img_path) }}" alt="Color Image"
                                    class="object-cover w-[154px] h-[115px] cursor-pointer color-image"
                                    data-large-src="{{ asset('storage/' . $color->pivot->img_path) }}">
                            @endif
                        @endforeach
                    </div>
                    {{-- Imagen principal --}}
                    <div style="width: 100%; height: 600px;" class="p-5">
                        <img id="mainImage" src="{{ asset('storage/' . $product->photo) }}" alt="Main Image"
                            class="object-cover w-full h-full">
                    </div>
                </div>
                {{-- Informacion del producto --}}
                <div class="bg-gray-100 p-4 shadow rounded flex items-center flex-col justify-evenly ml-9"
                    style="justify-content: space-evenly;">
                    <p class="text-gray-700">
                    <div style="width: 100%" class="text-2xl">
                        <strong class="text-navIcon">{{ $product->name }}</strong>
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12">
                        {{ $product->description }}
                    </div>
                    @php
                        $user = Auth::user();
                    @endphp
                    @auth
                        @if ($user->role_id == 3)
                            <div style="width: 100%" class="text-2xl ml-12">
                                <strong class="text-navIcon">Precio mayorista:
                                    ${{ number_format($product->wholesale_price) }}</strong>
                            </div>
                        @else
                            <div style="width: 100%" class="text-2xl ml-12">
                                <strong class="text-navIcon">${{ number_format($product->price) }}</strong>
                            </div>
                        @endif
                    @else
                        <div style="width: 100%" class="text-2xl ml-12">
                            <strong class="text-navIcon">${{ number_format($product->price) }}</strong>
                        </div>
                    @endauth

                    <div style="width: 100%" class="text-2xl ml-12 flex justify-around">
                        <h1 class="text-navIcon">Tallas</h1>
                        <div>
                            <button id="openModalBtn" style="color:#809c48;">Tabla de Tallas</button>
                        </div>
                    </div>
                    <div style="width: 55%" class="text-2xl ml-12 flex flex-col gap-5">
                        <x-select>
                            @foreach ($product->sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->value }}</option>
                            @endforeach
                        </x-select>
                        @auth
                            <x-primary-button class="content-center justify-center add-to-cart"
                                data-id="{{ $product->id }}">
                                Agregar al Carrito
                            </x-primary-button>
                        @endauth
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12 flex flex-col gap-7">
                        <strong>Colores</strong>
                        <div class="flex space-x-2">
                            @foreach ($product->colors as $color)
                                <div class="w-8 h-8 border-2 rounded-full"
                                    style="border-radius: 9999px;background-color:{{ $color->color_hex }};"></div>
                            @endforeach
                        </div>
                    </div>
                    <div style="width: 100%" class="text-2xl ml-12 flex flex-col gap-7 mt-5">
                        <strong>Temporadas</strong>
                        <div class="flex space-x-2">
                            <ul>
                                @foreach ($product->seasons as $season)
                                    <li>{{ $season->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    </p>
                </div>
            </div>

            <!-- Modal -->
            <div id="sizeChartModal"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div id="modalContent"
                    class="bg-white p-8 rounded shadow-md max-w-4xl w-full max-h-[90vh] overflow-auto">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-4">Tabla de Tallas</h2>
                        <button id="closeModalBtn" class="mt-4 px-4 py-2 bg-[#D5C4D7] text-white rounded">
                            <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                            Cerrar
                        </button>
                    </div>
                    <img src="{{ asset('storage/' . $product->photo_sizes) }}" alt="Tabla de Tallas"
                        class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal logic
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const sizeChartModal = document.getElementById('sizeChartModal');

            openModalBtn.addEventListener('click', function() {
                sizeChartModal.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', function() {
                sizeChartModal.classList.add('hidden');
            });

            // Close modal when clicking outside of the content
            window.addEventListener('click', function(event) {
                if (event.target == sizeChartModal) {
                    sizeChartModal.classList.add('hidden');
                }
            });

            // Image hover and click logic
            const colorImages = document.querySelectorAll('.color-image');
            const mainImage = document.getElementById('mainImage');
            let originalMainImageSrc = mainImage.src; // Guarda la imagen principal original

            colorImages.forEach(image => {
                image.addEventListener('mouseover', function() {
                    mainImage.src = this.getAttribute('data-large-src');
                });

                image.addEventListener('mouseout', function() {
                    mainImage.src = originalMainImageSrc; // Restaura la imagen principal original
                });

                /* image.addEventListener('click', function() {
                    mainImage.src = this.getAttribute('data-large-src');
                    originalMainImageSrc = mainImage
                        .src; // Actualiza la imagen principal original al hacer clic
                }); */
            });
        });
    </script>

    {{-- Estilos --}}
    <style>
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #D5C4D7 #FFFFFF;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 12px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #FFFFFF;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #D5C4D7;
            border-radius: 20px;
            border: 3px solid #FFFFFF;
        }

        #modalContent {
            max-width: 80%;
            /* Adjust the maximum width */
            max-height: 90%;
            /* Adjust the maximum height */
            width: 80%;
            /* Set the width */
            height: 80%;
            /* Set the height */
        }
    </style>
</x-shop-layout>
