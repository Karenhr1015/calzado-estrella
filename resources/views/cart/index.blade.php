<x-shop-layout>
    <div class="container mx-auto p-5">
        <h2 class="text-3xl font-bold mb-4">Carrito de Compras</h2>
        @if (session('cart'))
            <p>Total: {{ session('cart') ? session('cart_total', 0) : 0 }}</p>
            <p>Subtotal: ${{ session('cart') ? number_format(session('cart_total_cost', 0)) . ' COP' : 0 }}</p>
            <x-primary-button>
                <a href="{{ route('sales.index') }}">
                    Proceder al pago
                </a>
            </x-primary-button>
        @endif
        @if (session('cart'))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
                @foreach (session('cart') as $id => $details)
                    <div class="flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow p-4">
                        <img class="rounded-t-lg"
                            src="{{ $details['photo'] ? asset('storage/' . $details['photo']) : asset('img/avatars/avatar_default.png') }}"
                            alt="" class="w-150 h-150" />
                        <div class="flex flex-col flex-grow p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $details['name'] }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Cantidad:
                                {{ $details['quantity'] }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Precio del producto:
                                ${{ $details['price'] }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total de la compra:
                                ${{ $details['price'] * $details['quantity'] }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Detalles:
                            <ul>
                                @foreach ($details['sizes'] as $details_items)
                                    <li>
                                        <ul>
                                            @foreach ($details_items as $item)
                                                <li>Talla: {{ $item["name"]}} | Color: {{ $item["color"]}} | Total: {{ $item['total'] }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                            </p>
                            <div class="mt-4">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Eliminar del carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-700 dark:text-gray-400">Tu carrito está vacío.</p>
        @endif
    </div>
</x-shop-layout>
