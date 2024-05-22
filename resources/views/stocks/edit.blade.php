<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Editar Producto') }} : ({{ $stock->product->code }}) {{ $stock->product->name }}
                </h2>
                <br>
                <div class="flex space-x-2">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Colores:
                    </h2>
                    @foreach ($stock->product->colors as $color)
                        <div class="w-6 h-6 border-2 border-black-200" style="background-color:{{ $color->color_hex }};">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-4 py-3">
                <img src="{{ asset('storage/' . $stock->product->photo) }}" alt="" class="w-40 h-40">
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <form class="max-w-sm mx-auto" action="{{ route('stocks.update', $stock->id) }}" method="POST">
            @csrf
            @method('PUT')
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
