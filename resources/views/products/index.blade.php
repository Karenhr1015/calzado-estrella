<x-app-layout>
    {{-- Cabecera --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Productos
        </h2>
    </x-slot>
    {{-- Contenido --}}
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xxl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                {{-- Alertas --}}
                @if (session('status'))
                    <x-alert>
                        {{ session('status') }}
                    </x-alert>
                @endif
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    {{-- Cabecera de la tabla --}}
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center gap-3" action="{{ route('products.index') }}" method="GET">
                            <a href="{{ route('products.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512">
                                    <path fill="#080640"
                                        d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z" />
                                </svg>
                            </a>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="{{ __('Search') }}" required="">
                            </div>
                            <button type="submit"></button>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="{{ route('products.create') }}">
                            <x-primary-button>
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                {{ __('Añadir Producto') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">{{ __('Id') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Imagen') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Codigo') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Referencia') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Colores / Tallas') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Tipo de Producto') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Precio') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Precio mayorista') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Cantidad') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Estado') }}</th>
                                <th scope="col" class="px-4 py-3 ">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $product->id }}
                                    </th>
                                    <td class="px-4 py-3">
                                        <img src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('img/avatars/avatar_default.png') }}"
                                            alt="{{ $product->name }}" class="w-40 h-40">
                                    </td>
                                    <td class="px-4 py-3">{{ $product->code }}</td>
                                    <td class="px-4 py-3">{{ $product->name }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            @foreach ($product->colors as $color)
                                                <div class="w-6 h-6 border-2 border-black-200"
                                                    style="background-color:{{ $color->color_hex }};"></div>
                                            @endforeach
                                        </div>
                                        <br>
                                        <hr>
                                        <br>
                                        <div class="flex space-x-2">
                                            @foreach ($product->sizes as $size)
                                                <div class="w-10 h-10 text-lg">
                                                    {{ $size->value }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $product->product_type->name }}</td>
                                    <td class="px-4 py-3"><strong
                                            class="text-green-950 text-xl">{{ number_format($product->price) }}</strong>
                                    </td>
                                    <td class="px-4 py-3"><strong
                                            class="text-green-950 text-xl">{{ number_format($product->wholesale_price) }}</strong>
                                    </td>
                                    <td class="px-4 py-3"><strong
                                            class="text-purple-950 text-xl">{{ number_format($product->amount) }}</strong>
                                    </td>
                                    <td class="px-4 py-3">
                                        <x-status :type="$product->status"></x-status>
                                    </td>
                                    <td class="px-4 py-3 flex gap-5 content-center justify-items-center">
                                        {{-- Ver --}}
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <x-secondary-button>
                                                <div class="flex gap-2 items-center">
                                                    <svg data-slot="icon" fill="none" stroke-width="1.5"
                                                        stroke="currentColor" viewBox="0 0 24 24" class="h-5 w-5"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                                    </svg>
                                                    Ver
                                                </div>
                                            </x-secondary-button>
                                        </a>
                                        {{-- Editar --}}
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <x-secondary-button>
                                                <div class="flex gap-2 items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 512 512">
                                                        <path fill="#7ba7d7"
                                                            d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                                    </svg>
                                                    Editar
                                                </div>
                                            </x-secondary-button>
                                        </a>
                                        {{-- Inactivar --}}
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="status" value="{{ $product->status }}">
                                            <a :href="route('products.destroy', $product - > id)"
                                                onclick="event.preventDefault(); this.closest('form').submit()">
                                                <x-secondary-button>
                                                    <div class="flex gap-2 items-center">
                                                        <x-status-button :status="$product->status"></x-status-button>
                                                        {{ $product->status ? 'Inactivar' : 'Activar' }}
                                                    </div>
                                                </x-secondary-button>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            {{ $products->links() }}
        </div>
    </section>
</x-app-layout>
{{-- Scripts --}}
<script>
    function popDescription(text, name, code, talla, temporada) {
        Swal.fire({
            title: `Producto: (${code}) ${name} | Talla: ${talla} | Temporada: ${temporada}`,
            text: text,
            confirmButtonText: 'Cerrar',
        });
    }
</script>
