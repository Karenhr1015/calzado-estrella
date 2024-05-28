<x-shop-layout>
    <div class="container mx-auto p-5">
        <h2 class="text-3xl font-bold mb-4">Carrito de Compras</h2>
        @if (session('cart'))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach (session('cart') as $id => $details)
                    <div
                        class="flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow p-4">
                        <img class="rounded-t-lg"
                            src="{{ $details['photo'] ? asset('storage/' . $details['photo']) : asset('img/avatars/avatar_default.png') }}"
                            alt="" class="w-150 h-150" />
                        <div class="flex flex-col flex-grow p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $details['name'] }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Cantidad:
                                {{ $details['quantity'] }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Precio:
                                ${{ $details['price'] }}</p>
                            <div class="mt-auto">
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
