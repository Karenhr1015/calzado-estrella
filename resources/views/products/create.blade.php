<x-app-layout>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Producto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-4xl mx-auto" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Codigo --}}
                <div class="mb-5">
                    <x-input-label for="code" :value="__('Codigo')" />
                    <x-text-input id="code" class="block mt-1 w-full" name="code" :value="old('code')" autofocus
                        autocomplete="code" :placeholder="__('Ingrese el codigo...')" />
                    {{-- Codigo Validacion --}}
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                {{-- Referencia --}}
                <div class="mb-5">
                    <x-input-label for="name" :value="__('Nombre del producto')" />
                    <x-text-input id="name" class="block mt-1 w-full" name="name" :value="old('name')" autofocus
                        autocomplete="name" :placeholder="__('Ingrese el nombre del producto...')" />
                    {{-- Referencia Validacion --}}
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Colores --}}
                <div class="mb-5">
                    <x-input-label for="color_ids" :value="__('Colores')" />
                    <select id="color_ids" name="color_ids[]" multiple
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option></option>
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

                {{-- Talla --}}
                <div class="mb-5">
                    <x-input-label for="size_id" :value="__('Talla')" />
                    <x-select id="size_id" name="size_id">
                        <option></option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}" {{ $size->id == old('size_id') ? 'selected' : '' }}>
                                {{ $size->value }}</option>
                        @endforeach
                    </x-select>
                    {{-- Talla Validacion --}}
                    <x-input-error :messages="$errors->get('size_id')" class="mt-2" />
                </div>

                {{-- Tipo de producto --}}
                <div class="mb-5">
                    <x-input-label for="product_type_id" :value="__('Tipo de producto')" />
                    <x-select id="product_type_id" name="product_type_id">
                        <option></option>
                        @foreach ($product_types as $product_type)
                            <option value="{{ $product_type->id }}"
                                {{ $product_type->id == old('product_type_id') ? 'selected' : '' }}>
                                {{ $product_type->name }}</option>
                        @endforeach
                    </x-select>
                    {{-- Talla Validacion --}}
                    <x-input-error :messages="$errors->get('product_type_id')" class="mt-2" />
                </div>

                {{-- Temporada --}}
                <div class="mb-5">
                    <x-input-label for="season_id" :value="__('Temporada')" />
                    <x-select id="season_id" name="season_id">
                        <option></option>
                        @foreach ($seasons as $season)
                            <option value="{{ $season->id }}"
                                {{ $season->id == old('season_id') ? 'selected' : '' }}>
                                {{ $season->name }}</option>
                        @endforeach
                    </x-select>
                    {{-- Temporada Validacion --}}
                    <x-input-error :messages="$errors->get('season_id')" class="mt-2" />
                </div>

                {{-- Precio --}}
                <div class="mb-5">
                    <x-input-label for="price" :value="__('Precio')" />
                    <x-text-input id="price" class="block mt-1 w-full" name="price" :value="old('price')"
                        :placeholder="__('Ingrese el precio...')" type='number' min="0" />
                    {{-- Precio Validacion --}}
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                {{-- Precio mayorista --}}
                <div class="mb-5">
                    <x-input-label for="wholesale_price" :value="__('Precio mayorista')" />
                    <x-text-input id="wholesale_price" class="block mt-1 w-full" name="wholesale_price"
                        :value="old('wholesale_price')" :placeholder="__('Ingrese el precio mayorista...')" type='number' min="0" />
                    {{-- Precio Validacion --}}
                    <x-input-error :messages="$errors->get('wholesale_price')" class="mt-2" />
                </div>

                {{-- Descripcion --}}
                <div class="mb-5">
                    <x-input-label for="description" :value="__('Descripcion')" />
                    <textarea name="description" id="description"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            {{ old('description', '') }}
                    </textarea>
                    {{-- Precio Validacion --}}
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                {{-- Imagen --}}
                <div class="mb-5">
                    <x-input-label for="photo" :value="__('Foto del Producto')" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" />
                    {{-- Talla Validacion --}}
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>

            </div>

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-4">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#color_ids').select2({
                placeholder: "Seleccione los colores...",
                allowClear: true
            });
        });
    </script>
</x-app-layout>
