<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <div class="flex justify-evenly">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Editar Producto') }} : ({{ $product->code }}) {{ $product->name }}
                </h2>
                <br>
                <div class="flex space-x-2 mb-4">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Colores:
                    </h2>
                    @foreach ($product->colors as $color)
                        <div class="w-6 h-6 border-2 border-black-200" style="background-color:{{ $color->color_hex }};">
                        </div>
                    @endforeach
                </div>
                <div class="flex space-x-2">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Tallas:
                    </h2>
                    @foreach ($product->sizes as $size)
                        <div class="w-10 h-10">
                            {{ $size->value }} |
                        </div>
                    @endforeach
                </div>
                <div class="flex space-x-2">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Temporadas:
                    </h2>
                    <ul>
                        @foreach ($product->seasons as $season)
                            <li>
                                {{ $season->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="px-4 py-3">
                <img src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('img/avatars/avatar_default.png') }}"
                    alt="" class="w-40 h-40">
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <form class="max-w-4xl mx-auto" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Codigo --}}
                <div class="mb-5">
                    <x-input-label for="code" :value="__('Codigo')" />
                    <x-text-input id="code" class="block mt-1 w-full" name="code" :value="old('code', $product->code)" autofocus
                        autocomplete="code" :placeholder="__('Ingrese el codigo...')" />
                    {{-- Codigo Validacion --}}
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                {{-- Referencia --}}
                <div class="mb-5">
                    <x-input-label for="name" :value="__('Referencia')" />
                    <x-text-input id="name" class="block mt-1 w-full" name="name" :value="old('name', $product->name)" autofocus
                        autocomplete="name" :placeholder="__('Ingrese la referencia...')" />
                    {{-- Referencia Validacion --}}
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Colores --}}
                <div class="mb-5">
                    <x-input-label for="color_ids" :value="__('Colores')" />
                    <select id="color_ids" name="color_ids[]" multiple
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}"
                                {{ in_array($color->id, old('color_ids', [])) ? 'selected' : '' }}>
                                {{ $color->color }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Color Validacion --}}
                    <x-input-error :messages="$errors->get('color_ids')" class="mt-2" />
                </div>

                {{-- Tallas --}}
                <div class="mb-5">
                    <x-input-label for="sizes_ids" value="Tallas" />
                    <select id="sizes_ids" name="sizes_ids[]" multiple
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}"
                                {{ in_array($size->id, old('sizes_ids', [])) ? 'selected' : '' }}>
                                {{ $size->value }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Tallas Validacion --}}
                    <x-input-error :messages="$errors->get('sizes_ids')" class="mt-2" />
                </div>

                {{-- Tipo de producto --}}
                <div class="mb-5">
                    <x-input-label for="product_type_id" :value="__('Tipo de producto')" />
                    <x-select id="product_type_id" name="product_type_id">
                        <option></option>
                        @foreach ($product_types as $product_type)
                            <option value="{{ $product_type->id }}"
                                {{ $product_type->id == old('product_type_id', $product->product_type->id) ? 'selected' : '' }}>
                                {{ $product_type->name }}</option>
                        @endforeach
                    </x-select>
                    {{-- Talla Validacion --}}
                    <x-input-error :messages="$errors->get('product_type_id')" class="mt-2" />
                </div>

                {{-- Temporada --}}
                <div class="mb-5">
                    <x-input-label for="" value="Temporadas" />
                    <select id="seasons_ids" name="seasons_ids[]" multiple
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach ($seasons as $key => $season)
                            <option value="{{ $season->id }}"
                                {{ in_array($season->id, old('seasons_ids', [])) ? 'selected' : '' }}>
                                {{ $season->name }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Temporadas Validacion --}}
                    <x-input-error :messages="$errors->get('seasons_ids')" class="mt-2" />
                </div>

                {{-- Precio --}}
                <div class="mb-5">
                    <x-input-label for="price" :value="__('Precio')" />
                    <x-text-input id="price" class="block mt-1 w-full" name="price" :value="old('price', $product->price)"
                        :placeholder="__('Ingrese el precio...')" type='number' min="0" />
                    {{-- Precio Validacion --}}
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                {{-- Precio mayorista --}}
                <div class="mb-5">
                    <x-input-label for="wholesale_price" :value="__('Precio mayorista')" />
                    <x-text-input id="wholesale_price" class="block mt-1 w-full" name="wholesale_price"
                        :value="old('wholesale_price', $product->wholesale_price)" :placeholder="__('Ingrese el precio mayorista...')" type='number' min="0" />
                    {{-- Precio Validacion --}}
                    <x-input-error :messages="$errors->get('wholesale_price')" class="mt-2" />
                </div>

                {{-- Descripcion --}}
                <div class="mb-5">
                    <x-input-label for="description" :value="__('Descripcion')" />
                    <textarea name="description" id="description"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            {{ old('description', $product->description) }}
                    </textarea>
                    {{-- Precio Validacion --}}
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                {{-- Cantidad --}}
                <div class="mb-5">
                    <x-input-label for="amount" :value="__('Cantidad')" />
                    <x-text-input id="amount" class="block mt-1 w-full" name="amount" :value="old('amount', $product->amount)"
                        :placeholder="__('Ingrese la cantidad...')" type='number' min="0" />
                    {{-- Cantidad Validacion --}}
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                {{-- Imagen --}}
                <div class="mb-5">
                    <x-input-label for="photo" :value="__('Cambiar Foto del Producto')" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" />
                    {{-- Imagen principal Validacion --}}
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />

                    <x-input-label for="photo_sizes" :value="__('Tabla de tallas')" class="mt-2" />
                    <x-text-input id="photo_sizes" class="block mt-1 w-full" type="file" name="photo_sizes" />
                    {{-- Imagen tabla de tallas Validacion --}}
                    <x-input-error :messages="$errors->get('photo_sizes')" class="mt-2" />
                </div>
            </div>

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-4">
                {{ __('Guardar') }}
            </x-primary-button>
            {{-- Btn Cancelar --}}
            <a href="{{ route('products.index') }}">
                <x-cancel-button type="button" class="mt-4 text-white bg-red-800 hover:bg-red-700">
                    Cancelar
                </x-cancel-button>
            </a>
        </form>
    </div>
</x-app-layout>
