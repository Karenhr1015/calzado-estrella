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
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                            <div class="bg-white p-4 shadow rounded">
                                <h1 class="text-lg font-bold mb-4">Venta: {{ $sale->uuid }}</h1>
                                <ul>
                                    <li>
                                        <p class="text-lg mb-2">Fecha de creacion: {{ $sale->created_at }}</p>
                                    </li>
                                    <li>
                                        <p class="text-lg mb-2">{{ $sale->created_at->diffForHumans() }}</p>
                                    </li>
                                    <li>
                                        @if ($sale->pay)
                                            <span
                                                class="bg-green-100 text-gray font-bold py-2 px-4 rounded">{{ __('Cancelada') }}</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-gray font-bold py-2 px-4 rounded">{{ __('Sin cancelar') }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- Mas informacion del producto --}}
                    <div class="bg-white p-4 shadow rounded">
                        <div class="bg-white p-4 shadow rounded">
                            <div>
                                <h1 class="text-xl font-bold">Datos del cliente:</h1>
                                <br>
                                <h2 class="text-lg font-bold">Correo</h2>
                                <p class="text-sm font-semibold text-purple-800">
                                    {{ $sale->user->email }}
                                </p>
                                <h2 class="text-lg font-bold">Nombres y apellidos</h2>
                                <p class="text-sm font-semibold text-purple-800">
                                    {{ $sale->names }} {{ $sale->lastnames }}
                                </p>
                                <h2 class="text-lg font-bold">Numero de cuenta o telefono</h2>
                                <p class="text-sm font-semibold text-purple-800">
                                    {{ $sale->account_number }}
                                </p>
                                <h2 class="text-lg font-bold">Telefono movil</h2>
                                <p class="text-sm font-semibold text-purple-800">
                                    {{ $sale->mobile_phone ?? 'No registra' }}
                                </p>
                                <h2 class="text-lg font-bold">Direccion y barrio</h2>
                                <p class="text-sm font-semibold text-purple-800">
                                <ul>
                                    <li><strong class="text-sm font-semibold text-purple-800">Direccion:</strong>
                                        {{ $sale->address }}</li>
                                    <li><strong class="text-sm font-semibold text-purple-800">Barrio:</strong>
                                        {{ $sale->neighborhood }}</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-5">
                    <div class="bg-white p-4 shadow rounded">
                        Total del pedido: <span id="total_price"></span>
                    </div>
                    <div class="bg-white p-4 shadow rounded">
                        <form action="{{ route('sales.confirm', $sale->uuid) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ $sale->pay }}">
                            @if (!$sale->pay)
                                <x-primary-button class="bg-green-800 hover:bg-green-600">
                                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 mr-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                                        </path>
                                    </svg>
                                    Confirmar pago
                                </x-primary-button>
                            @else
                                <x-primary-button class="bg-red-800 hover:bg-red-600">
                                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 mr-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                                        </path>
                                    </svg>
                                    Desconfirmar pago
                                </x-primary-button>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-5">
                    <div class="bg-white p-4 shadow rounded">
                        <div class="overflow-x-auto">
                            @php
                                $total_order = 0;
                            @endphp
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-4">{{ __('ID') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Imagen') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Producto') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Precio unitario') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Talla') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Color') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Cantidad') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Precio total') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale->sales_details as $detail)
                                        @php
                                            $total_order += $detail->total_price;
                                        @endphp
                                        <tr class="border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $detail->id }}
                                            </th>
                                            <td class="px-4 py-3">
                                                <img src="{{ $detail->product->photo ? asset('storage/' . $detail->product->photo) : asset('img/avatars/avatar_default.png') }}"
                                                    alt="{{ $detail->product->name }}" class="w-32 h-32">
                                            </td>
                                            <td class="px-4 py-3">{{ $detail->product->name }}</td>
                                            <td class="px-4 py-3">${{ number_format($detail->product->price) }}</td>
                                            <td class="px-4 py-3">{{ $detail->size->value }}</td>
                                            <td class="px-4 py-3">
                                                <div class="w-6 h-6 border-2 border-black-200"
                                                    style="background-color:{{ $detail->color->color_hex }};"></div>
                                                <br>
                                                {{ $detail->color->color }}
                                            </td>
                                            <td class="px-4 py-3">{{ $detail->quantity }}</td>
                                            <td class="px-4 py-3 text-xl font-bold">
                                                ${{ number_format($detail->total_price) }}</td>
                                        </tr>
                                    @endforeach
                                    <script>
                                        const numberFormatCost = new Intl.NumberFormat('es-ES', {
                                            style: 'currency',
                                            currency: 'COP',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0,
                                        });
                                        document.getElementById('total_price').textContent = '$' + numberFormatCost.format({{ $total_order }})
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
