<x-shop-layout>
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
                                        {{-- <th scope="col" class="px-4 py-4">{{ __('ID') }}</th> --}}
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
                                            {{-- <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $detail->id }}
                                            </th> --}}
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
