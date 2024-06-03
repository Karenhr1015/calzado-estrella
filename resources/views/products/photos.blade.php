<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xxl px-4 lg:px-12">
            {{-- Alertas --}}
            @if (session('status'))
                <x-alert>
                    {{ session('status') }}
                </x-alert>
            @endif
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Imagen y informacion del producto --}}
                    <div class="bg-white p-4 shadow rounded">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-4 shadow rounded">
                                <div class="flex justify-center p-4">
                                    <img src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('img/avatars/avatar_default.png') }}"
                                        alt="{{ $product->name }}" class="w-full h-auto max-w-md w-50 h-50">
                                </div>
                            </div>
                            <div class="bg-white p-4 shadow rounded">
                                <h1 class="text-lg font-bold mb-4">({{ $product->code }}) {{ $product->name }}</h1>
                                <p class="text-xs mb-2 overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $product->description }}</p>
                                {{-- Cantidades y Precios --}}
                                <div>
                                    <h2 class="text-lg font-bold">Cantidad</h2>
                                    <p class="text-sm font-semibold text-purple-800">
                                        {{ number_format($product->amount) }}
                                    </p>
                                    <h2 class="text-lg font-bold">Precio</h2>
                                    <p class="text-sm font-semibold text-green-700">
                                        ${{ number_format($product->price) }}
                                    </p>
                                    <h2 class="text-lg font-bold">Precio Mayorista</h2>
                                    <p class="text-sm font-semibold text-green-700">
                                        ${{ number_format($product->wholesale_price) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Mas informacion del producto --}}
                    <div class="bg-white p-4 shadow rounded">
                        <div class="bg-white p-4 shadow rounded">
                            {{-- Colores --}}
                            <div class="p-4">
                                <h2 class="text-lg font-bold mb-4">Colores</h2>
                                <div class="flex space-x-2">
                                    @foreach ($product->colors as $color)
                                        <div class="w-6 h-6 border-2 border-black-200"
                                            style="background-color:{{ $color->color_hex }};"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-7">
                                <div class="bg-white p-4 shadow rounded">
                                    {{-- Tallas --}}
                                    <div class="p-4">
                                        <h2 class="text-lg font-bold mb-4">Tallas</h2>
                                        <div class="flex space-x-2">
                                            @foreach ($product->sizes as $size)
                                                <div class="w-10 h-10 border-2-black-200 text-lg">
                                                    <strong>{{ $size->value }}</strong>
                                                </div> |
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-4 shadow rounded">
                                    {{-- Temporadas --}}
                                    <div class="p-4">
                                        <h2 class="text-lg font-bold mb-4">Temporadas</h2>
                                        <div class="flex space-x-2">
                                            <ul>
                                                @foreach ($product->seasons as $season)
                                                    <li>
                                                        <strong>- {{ $season->name }}</strong>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Acciones --}}
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-7">
                    <div class="bg-white p-4 shadow rounded">
                        <form action="{{ route('products.photos_store', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-7">
                                <div>
                                    {{-- Colores --}}
                                    <div class="mb-5">
                                        <x-input-label for="color_id" :value="__('Color')" />
                                        <select id="color_id" name="color_id"
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            @foreach ($product->colors as $color)
                                                <option value="{{ $color->id }}">
                                                    {{ $color->color }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- Colores Validacion --}}
                                        <x-input-error :messages="$errors->get('color_id')" class="mt-2" />
                                    </div>
                                    <input type="file" name="image" id="imageInput">
                                    {{-- Image Validacion --}}
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <div>
                                    <div id="imagePreview" class="h-[150px] w-[150px]">

                                    </div>
                                </div>
                                <div>
                                    <x-primary-button type="submit">
                                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 mr-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z">
                                            </path>
                                        </svg>Guardar cambios
                                    </x-primary-button>
                                    <a href="{{ route('products.index') }}">
                                        <x-secondary-button type="button" class="mt-4 bg-yellow-400">
                                            <svg data-slot="icon" fill="none" stroke-width="1.5"
                                                stroke="currentColor" class="w-5 h-5 mr-4" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12">
                                                </path>
                                            </svg>
                                            Cancelar
                                        </x-secondary-button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- Tabla de colores --}}
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-7">
                    <div class="bg-white p-4 shadow rounded">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3" colspan="2">
                                        Nombre del color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Imagen
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->colors as $color)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th>
                                            <div class="w-6 h-6 border-2 border-black-200"
                                                style="background-color:{{ $color->color_hex }};"></div>
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $color->color }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ $color->pivot->img_path ? asset('storage/' . $color->pivot->img_path) : asset('img/avatars/avatar_default.png') }}"
                                                alt="imagen por color" class="w-40 h-40">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Limpiar cualquier vista previa anterior
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.className = 'h-[150px] w-[150px] rounded shadow';
                    imagePreview.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
