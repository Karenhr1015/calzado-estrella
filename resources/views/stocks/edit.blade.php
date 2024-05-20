<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar producto del Inventario') }} : ({{ $stock->product->code }})
            {{ $stock->product->name }} | Color:
            {{ $stock->product->color->color }} | Talla: {{ $stock->product->size->value }} | Temporada:
            {{ $stock->product->season->name }}
            | Precio: {{ $stock->product->price }} | Cantidad: {{ $stock->amount }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('stocks.update', $stock->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Producto --}}
            <div class="mb-5">
                <x-input-label for="product_id" :value="__('Producto')" />
                <x-select id="product_id" name="product_id">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                            {{ $product->name }}</option>
                    @endforeach
                </x-select>
                {{-- Producto Validacion --}}
                <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
            </div>

            {{-- Cantidad disponible --}}
            <div class="mb-5">
                <x-input-label for="amount" :value="__('Cantidad disponible')" />
                <x-text-input id="amount" class="block mt-1 w-full" name="amount" :value="old('amount', $stock->amount)" autofocus
                    autocomplete="amount" :placeholder="__('Ingresa la cantidad disponible...')" type="number" min="0" />
            </div>
            {{-- Cantidad disponible Validacion --}}
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />

            {{-- Btn Submit --}}
            <x-primary-button type="submit" class="mt-2">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
