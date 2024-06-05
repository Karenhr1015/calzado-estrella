<x-shop-layout>
    {{-- Contenido --}}
    <div class="py-7 flex flex-wrap justify-center gap-8">
        <div class="container mx-auto p-2">
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-64">
                    {{-- Datos --}}
                    <div class="bg-gray-100 shadow rounded p-10">
                        <h1 class="text-[#080640] font-bold mb-5">Dirección de entrega</h1>
                        <hr>
                        <div class="mb-10 mt-10">
                            <p>Escriba la dirección donde se va recibir el pedido</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96">
                            <div>
                                {{-- Nombres --}}
                                <div class="mb-5">
                                    <x-input-label class="text-[#080640] font-bold" for="names" :value="__('Nombres') . '*'" />
                                    <x-text-input id="names" class="block mt-1 w-full" name="names"
                                        :value="old('names')" autofocus autocomplete="names" :placeholder="__('Ingrese sus nombres...')" />
                                    {{-- Nombres Validacion --}}
                                    <x-input-error :messages="$errors->get('names')" class="mt-2" />
                                </div>

                                {{-- Numero cuenta o telefono --}}
                                <div class="mb-5">
                                    <x-input-label class="text-[#080640] font-bold" for="account_number"
                                        :value="__('Número de cuenta o teléfono') . '*'" />
                                    <x-text-input id="account_number" class="block mt-1 w-full" name="account_number"
                                        :value="old('account_number')" autofocus autocomplete="account_number" :placeholder="__('Ingrese su número de cuenta o telefono del pago...')" />
                                    {{-- Numero cuenta o telefono  --}}
                                    <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                                </div>

                                {{-- Direccion --}}
                                <div class="mb-5">
                                    <x-input-label class="text-[#080640] font-bold" for="address" :value="__('Dirección') . '*'" />
                                    <x-text-input id="address" class="block mt-1 w-full" name="address"
                                        :value="old('address')" autofocus autocomplete="address" :placeholder="__('Ingrese su dirección...')" />
                                    {{-- Direccion Validacion --}}
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                {{-- Apellidos --}}
                                <div class="mb-5">
                                    <x-input-label class="text-[#080640] font-bold" for="lastnames"
                                        :value="__('Apellidos') . '*'" />
                                    <x-text-input id="lastnames" class="block mt-1 w-full" name="lastnames"
                                        :value="old('lastnames')" autofocus autocomplete="lastnames" :placeholder="__('Ingrese sus apellidos...')" />
                                    {{-- Apellidos Validacion --}}
                                    <x-input-error :messages="$errors->get('lastnames')" class="mt-2" />
                                </div>

                                {{-- Telefono movil --}}
                                <div class="mb-5">
                                    <x-input-label class="text-[#080640] font-bold" for="mobile_phone"
                                        :value="__('Teléfono móvil')" />
                                    <x-text-input id="mobile_phone" class="block mt-1 w-full" name="mobile_phone"
                                        :value="old('mobile_phone')" autofocus autocomplete="mobile_phone" :placeholder="__('Ingrese su teleéono móvil...')" />
                                    {{-- Telefono movil Validacion --}}
                                    <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
                                </div>

                                {{-- Barrio movil --}}
                                <div class="mb-5">
                                    <x-input-label class="text-[#080640] font-bold" for="neighborhood"
                                        :value="__('Barrio') . '*'" />
                                    <x-text-input id="neighborhood" class="block mt-1 w-full" name="neighborhood"
                                        :value="old('neighborhood')" autofocus autocomplete="neighborhood" :placeholder="__('Ingrese su Barrio...')" />
                                    {{-- Barrio movil Validacion --}}
                                    <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="flex content-center justify-center	mt-5">
                            <x-primary-button type="button">
                                Guardar direccion
                            </x-primary-button>
                        </div>
                        <div class="flex content-center mt-5">
                            <ul>
                                <li>
                                    <p><span class="tex-[#080640] font-bold">(1)</span> Ten en cuenta que el precio del
                                        domicilio puede variar, se tendrá contacto por el número que digites en el
                                        formulario, para coordinar el precio del domicilio.</p>
                                </li>
                                <li>
                                    <p><span class="tex-[#080640] font-bold">(2)</span>Verificar la informacion del
                                        domicilio que coincida con los datos de la cuenta desde la cual se realizará el
                                        pago.</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Resumen de la compra --}}
                    <div class="bg-[#D5C4D7] p-4 shadow rounded" style="height: 600px;">
                        <div class="grid grid-cols-1 md:grid-cols-1">
                            <h1 class="text-[#080640] font-bold mb-5">Resumen de la compra</h1>
                            <hr>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-96 mt-5 p-5 overflow-auto">
                                @foreach (session('cart') as $id => $details)
                                    <div>
                                        <img class="rounded-t-lg"
                                            src="{{ $details['photo'] ? asset('storage/' . $details['photo']) : asset('img/avatars/avatar_default.png') }}"
                                            alt="" class="w-150 h-150" />
                                    </div>
                                    <div>
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $details['name'] }}</h5>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Cantidad:
                                            {{ $details['quantity'] }}</p>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Tallas:
                                        <ul>
                                            @foreach ($details['sizes'] as $details_items)
                                                <li>
                                                    <ul>
                                                        @foreach ($details_items as $item)
                                                            <hr>
                                                            <li>Talla: {{ $item['name'] }} | Color: {{ $item['color'] }}
                                                            </li>
                                                            <li>Total: {{ $item['total'] }}</li>
                                                            <hr>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                    <div>
                                        <span class="tex-[#080640] font-bold">Precio unitario:</span>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            ${{ $details['price'] }}</p>

                                        <span class="tex-[#080640] font-bold">Precio total de la compra:</span>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            ${{ $details['price'] * $details['quantity'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="mt-5 flex justify-center">
                                <x-primary-button type="button" id="openModalBtn">
                                    Realizar el pago con codigo QR
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M2 16.9C2 15.5906 2 14.9359 2.29472 14.455C2.45963 14.1859 2.68589 13.9596 2.955 13.7947C3.43594 13.5 4.09063 13.5 5.4 13.5H6.5C8.38562 13.5 9.32843 13.5 9.91421 14.0858C10.5 14.6716 10.5 15.6144 10.5 17.5V18.6C10.5 19.9094 10.5 20.5641 10.2053 21.045C10.0404 21.3141 9.81411 21.5404 9.545 21.7053C9.06406 22 8.40937 22 7.1 22C5.13594 22 4.15391 22 3.4325 21.5579C3.02884 21.3106 2.68945 20.9712 2.44208 20.5675"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path
                                                d="M22 7.1C22 8.40937 22 9.06406 21.7053 9.545C21.5404 9.81411 21.3141 10.0404 21.045 10.2053C20.5641 10.5 19.9094 10.5 18.6 10.5H17.5C15.6144 10.5 14.6716 10.5 14.0858 9.91421C13.5 9.32843 13.5 8.38562 13.5 6.5V5.4C13.5 4.09063 13.5 3.43594 13.7947 2.955C13.9596 2.68589 14.1859 2.45963 14.455 2.29472C14.9359 2 15.5906 2 16.9 2C18.8641 2 19.8461 2 20.5675 2.44208C20.9712 2.68945 21.3106 3.02884 21.5579 3.4325"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path
                                                d="M16.5 6.25C16.5 5.73459 16.5 5.47689 16.6291 5.29493C16.6747 5.23072 16.7307 5.17466 16.7949 5.12911C16.9769 5 17.2346 5 17.75 5C18.2654 5 18.5231 5 18.7051 5.12911C18.7693 5.17466 18.8253 5.23072 18.8709 5.29493C19 5.47689 19 5.73459 19 6.25C19 6.76541 19 7.02311 18.8709 7.20507C18.8253 7.26928 18.7693 7.32534 18.7051 7.37089C18.5231 7.5 18.2654 7.5 17.75 7.5C17.2346 7.5 16.9769 7.5 16.7949 7.37089C16.7307 7.32534 16.6747 7.26928 16.6291 7.20507C16.5 7.02311 16.5 6.76541 16.5 6.25Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M12.75 22C12.75 22.4142 13.0858 22.75 13.5 22.75C13.9142 22.75 14.25 22.4142 14.25 22H12.75ZM14.3889 13.8371L14.8055 14.4607L14.8055 14.4607L14.3889 13.8371ZM13.8371 14.3889L13.2135 13.9722L13.2135 13.9722L13.8371 14.3889ZM19 12.75H17V14.25H19V12.75ZM12.75 19V22H14.25V19H12.75ZM17 12.75C16.3134 12.75 15.742 12.7491 15.281 12.796C14.8075 12.8441 14.3682 12.9489 13.9722 13.2135L14.8055 14.4607C14.914 14.3882 15.078 14.3244 15.4328 14.2883C15.8002 14.2509 16.2822 14.25 17 14.25V12.75ZM14.25 17C14.25 16.2822 14.2509 15.8002 14.2883 15.4328C14.3244 15.078 14.3882 14.914 14.4607 14.8055L13.2135 13.9722C12.9489 14.3682 12.8441 14.8075 12.796 15.281C12.7491 15.742 12.75 16.3134 12.75 17H14.25ZM13.9722 13.2135C13.6719 13.4141 13.4141 13.6719 13.2135 13.9722L14.4607 14.8055C14.5519 14.669 14.669 14.5519 14.8055 14.4607L13.9722 13.2135Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M22.75 13.5C22.75 13.0858 22.4142 12.75 22 12.75C21.5858 12.75 21.25 13.0858 21.25 13.5H22.75ZM20.7654 21.8478L21.0524 22.5407L21.0524 22.5407L20.7654 21.8478ZM21.8478 20.7654L21.1548 20.4784V20.4784L21.8478 20.7654ZM17 22.75H19V21.25H17V22.75ZM22.75 17V13.5H21.25V17H22.75ZM19 22.75C19.4557 22.75 19.835 22.7504 20.1454 22.7292C20.4625 22.7076 20.762 22.661 21.0524 22.5407L20.4784 21.1548C20.4012 21.1868 20.284 21.2163 20.0433 21.2327C19.7958 21.2496 19.4762 21.25 19 21.25V22.75ZM21.25 19C21.25 19.4762 21.2496 19.7958 21.2327 20.0433C21.2163 20.284 21.1868 20.4012 21.1548 20.4784L22.5407 21.0524C22.661 20.762 22.7076 20.4625 22.7292 20.1454C22.7504 19.835 22.75 19.4557 22.75 19H21.25ZM21.0524 22.5407C21.7262 22.2616 22.2616 21.7262 22.5407 21.0524L21.1548 20.4784C21.028 20.7846 20.7846 21.028 20.4784 21.1549L21.0524 22.5407Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M2 7.1C2 5.13594 2 4.15391 2.44208 3.4325C2.68945 3.02884 3.02884 2.68945 3.4325 2.44208C4.15391 2 5.13594 2 7.1 2C8.40937 2 9.06406 2 9.545 2.29472C9.81411 2.45963 10.0404 2.68589 10.2053 2.955C10.5 3.43594 10.5 4.09063 10.5 5.4V6.5C10.5 8.38562 10.5 9.32843 9.91421 9.91421C9.32843 10.5 8.38562 10.5 6.5 10.5H5.4C4.09063 10.5 3.43594 10.5 2.955 10.2053C2.68589 10.0404 2.45963 9.81411 2.29472 9.545C2 9.06406 2 8.40937 2 7.1Z"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                            <path
                                                d="M5 6.25C5 5.73459 5 5.47689 5.12911 5.29493C5.17466 5.23072 5.23072 5.17466 5.29493 5.12911C5.47689 5 5.73459 5 6.25 5C6.76541 5 7.02311 5 7.20507 5.12911C7.26928 5.17466 7.32534 5.23072 7.37089 5.29493C7.5 5.47689 7.5 5.73459 7.5 6.25C7.5 6.76541 7.5 7.02311 7.37089 7.20507C7.32534 7.26928 7.26928 7.32534 7.20507 7.37089C7.02311 7.5 6.76541 7.5 6.25 7.5C5.73459 7.5 5.47689 7.5 5.29493 7.37089C5.23072 7.32534 5.17466 7.26928 5.12911 7.20507C5 7.02311 5 6.76541 5 6.25Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M5 17.75C5 17.2346 5 16.9769 5.12911 16.7949C5.17466 16.7307 5.23072 16.6747 5.29493 16.6291C5.47689 16.5 5.73459 16.5 6.25 16.5C6.76541 16.5 7.02311 16.5 7.20507 16.6291C7.26928 16.6747 7.32534 16.7307 7.37089 16.7949C7.5 16.9769 7.5 17.2346 7.5 17.75C7.5 18.2654 7.5 18.5231 7.37089 18.7051C7.32534 18.7693 7.26928 18.8253 7.20507 18.8709C7.02311 19 6.76541 19 6.25 19C5.73459 19 5.47689 19 5.29493 18.8709C5.23072 18.8253 5.17466 18.7693 5.12911 18.7051C5 18.5231 5 18.2654 5 17.75Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M16 17.75C16 17.0478 16 16.6967 16.1685 16.4444C16.2415 16.3352 16.3352 16.2415 16.4444 16.1685C16.6967 16 17.0478 16 17.75 16C18.4522 16 18.8033 16 19.0556 16.1685C19.1648 16.2415 19.2585 16.3352 19.3315 16.4444C19.5 16.6967 19.5 17.0478 19.5 17.75C19.5 18.4522 19.5 18.8033 19.3315 19.0556C19.2585 19.1648 19.1648 19.2585 19.0556 19.3315C18.8033 19.5 18.4522 19.5 17.75 19.5C17.0478 19.5 16.6967 19.5 16.4444 19.3315C16.3352 19.2585 16.2415 19.1648 16.1685 19.0556C16 18.8033 16 18.4522 16 17.75Z"
                                                fill="#ffffff"></path>
                                        </g>
                                    </svg>
                                </x-primary-button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="cart" value="{{ json_encode(session('cart')) }}">

                </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="sizeChartModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div id="modalContent" class="bg-white p-8 rounded shadow-md max-w-4xl w-full max-h-[95vh] overflow-auto">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold mb-4">Pago con QR</h2>
                <button id="closeModalBtn" class="mt-4 px-4 py-2 bg-[#D5C4D7] text-white rounded">
                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>
                    Cerrar
                </button>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-2">
                <img src="{{ asset('qr/qrcode-generado.png') }}" alt="Qr de pago" class="w-[100%] h-[100%]">
                <div>
                    <ul>
                        <li><span class="text-lg text-purple-800 font-bold">(1)</span> Una vez realizado el pago, la
                            tienda verifica su pago y le informará los detalles del envio</li>
                        <li><span class="text-lg text-purple-800 font-bold">(2)</span> Los datos del formulario deben
                            coincidir con la cuenta desde la que se realizara el pago</li>
                    </ul>
                    <br>
                    <hr>
                    <x-primary-button type="submit" class="mt-5">
                        Finalizar la compra
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                            </g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M2 16.9C2 15.5906 2 14.9359 2.29472 14.455C2.45963 14.1859 2.68589 13.9596 2.955 13.7947C3.43594 13.5 4.09063 13.5 5.4 13.5H6.5C8.38562 13.5 9.32843 13.5 9.91421 14.0858C10.5 14.6716 10.5 15.6144 10.5 17.5V18.6C10.5 19.9094 10.5 20.5641 10.2053 21.045C10.0404 21.3141 9.81411 21.5404 9.545 21.7053C9.06406 22 8.40937 22 7.1 22C5.13594 22 4.15391 22 3.4325 21.5579C3.02884 21.3106 2.68945 20.9712 2.44208 20.5675"
                                    stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M22 7.1C22 8.40937 22 9.06406 21.7053 9.545C21.5404 9.81411 21.3141 10.0404 21.045 10.2053C20.5641 10.5 19.9094 10.5 18.6 10.5H17.5C15.6144 10.5 14.6716 10.5 14.0858 9.91421C13.5 9.32843 13.5 8.38562 13.5 6.5V5.4C13.5 4.09063 13.5 3.43594 13.7947 2.955C13.9596 2.68589 14.1859 2.45963 14.455 2.29472C14.9359 2 15.5906 2 16.9 2C18.8641 2 19.8461 2 20.5675 2.44208C20.9712 2.68945 21.3106 3.02884 21.5579 3.4325"
                                    stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M16.5 6.25C16.5 5.73459 16.5 5.47689 16.6291 5.29493C16.6747 5.23072 16.7307 5.17466 16.7949 5.12911C16.9769 5 17.2346 5 17.75 5C18.2654 5 18.5231 5 18.7051 5.12911C18.7693 5.17466 18.8253 5.23072 18.8709 5.29493C19 5.47689 19 5.73459 19 6.25C19 6.76541 19 7.02311 18.8709 7.20507C18.8253 7.26928 18.7693 7.32534 18.7051 7.37089C18.5231 7.5 18.2654 7.5 17.75 7.5C17.2346 7.5 16.9769 7.5 16.7949 7.37089C16.7307 7.32534 16.6747 7.26928 16.6291 7.20507C16.5 7.02311 16.5 6.76541 16.5 6.25Z"
                                    fill="#ffffff"></path>
                                <path
                                    d="M12.75 22C12.75 22.4142 13.0858 22.75 13.5 22.75C13.9142 22.75 14.25 22.4142 14.25 22H12.75ZM14.3889 13.8371L14.8055 14.4607L14.8055 14.4607L14.3889 13.8371ZM13.8371 14.3889L13.2135 13.9722L13.2135 13.9722L13.8371 14.3889ZM19 12.75H17V14.25H19V12.75ZM12.75 19V22H14.25V19H12.75ZM17 12.75C16.3134 12.75 15.742 12.7491 15.281 12.796C14.8075 12.8441 14.3682 12.9489 13.9722 13.2135L14.8055 14.4607C14.914 14.3882 15.078 14.3244 15.4328 14.2883C15.8002 14.2509 16.2822 14.25 17 14.25V12.75ZM14.25 17C14.25 16.2822 14.2509 15.8002 14.2883 15.4328C14.3244 15.078 14.3882 14.914 14.4607 14.8055L13.2135 13.9722C12.9489 14.3682 12.8441 14.8075 12.796 15.281C12.7491 15.742 12.75 16.3134 12.75 17H14.25ZM13.9722 13.2135C13.6719 13.4141 13.4141 13.6719 13.2135 13.9722L14.4607 14.8055C14.5519 14.669 14.669 14.5519 14.8055 14.4607L13.9722 13.2135Z"
                                    fill="#ffffff"></path>
                                <path
                                    d="M22.75 13.5C22.75 13.0858 22.4142 12.75 22 12.75C21.5858 12.75 21.25 13.0858 21.25 13.5H22.75ZM20.7654 21.8478L21.0524 22.5407L21.0524 22.5407L20.7654 21.8478ZM21.8478 20.7654L21.1548 20.4784V20.4784L21.8478 20.7654ZM17 22.75H19V21.25H17V22.75ZM22.75 17V13.5H21.25V17H22.75ZM19 22.75C19.4557 22.75 19.835 22.7504 20.1454 22.7292C20.4625 22.7076 20.762 22.661 21.0524 22.5407L20.4784 21.1548C20.4012 21.1868 20.284 21.2163 20.0433 21.2327C19.7958 21.2496 19.4762 21.25 19 21.25V22.75ZM21.25 19C21.25 19.4762 21.2496 19.7958 21.2327 20.0433C21.2163 20.284 21.1868 20.4012 21.1548 20.4784L22.5407 21.0524C22.661 20.762 22.7076 20.4625 22.7292 20.1454C22.7504 19.835 22.75 19.4557 22.75 19H21.25ZM21.0524 22.5407C21.7262 22.2616 22.2616 21.7262 22.5407 21.0524L21.1548 20.4784C21.028 20.7846 20.7846 21.028 20.4784 21.1549L21.0524 22.5407Z"
                                    fill="#ffffff"></path>
                                <path
                                    d="M2 7.1C2 5.13594 2 4.15391 2.44208 3.4325C2.68945 3.02884 3.02884 2.68945 3.4325 2.44208C4.15391 2 5.13594 2 7.1 2C8.40937 2 9.06406 2 9.545 2.29472C9.81411 2.45963 10.0404 2.68589 10.2053 2.955C10.5 3.43594 10.5 4.09063 10.5 5.4V6.5C10.5 8.38562 10.5 9.32843 9.91421 9.91421C9.32843 10.5 8.38562 10.5 6.5 10.5H5.4C4.09063 10.5 3.43594 10.5 2.955 10.2053C2.68589 10.0404 2.45963 9.81411 2.29472 9.545C2 9.06406 2 8.40937 2 7.1Z"
                                    stroke="#ffffff" stroke-width="1.5"></path>
                                <path
                                    d="M5 6.25C5 5.73459 5 5.47689 5.12911 5.29493C5.17466 5.23072 5.23072 5.17466 5.29493 5.12911C5.47689 5 5.73459 5 6.25 5C6.76541 5 7.02311 5 7.20507 5.12911C7.26928 5.17466 7.32534 5.23072 7.37089 5.29493C7.5 5.47689 7.5 5.73459 7.5 6.25C7.5 6.76541 7.5 7.02311 7.37089 7.20507C7.32534 7.26928 7.26928 7.32534 7.20507 7.37089C7.02311 7.5 6.76541 7.5 6.25 7.5C5.73459 7.5 5.47689 7.5 5.29493 7.37089C5.23072 7.32534 5.17466 7.26928 5.12911 7.20507C5 7.02311 5 6.76541 5 6.25Z"
                                    fill="#ffffff"></path>
                                <path
                                    d="M5 17.75C5 17.2346 5 16.9769 5.12911 16.7949C5.17466 16.7307 5.23072 16.6747 5.29493 16.6291C5.47689 16.5 5.73459 16.5 6.25 16.5C6.76541 16.5 7.02311 16.5 7.20507 16.6291C7.26928 16.6747 7.32534 16.7307 7.37089 16.7949C7.5 16.9769 7.5 17.2346 7.5 17.75C7.5 18.2654 7.5 18.5231 7.37089 18.7051C7.32534 18.7693 7.26928 18.8253 7.20507 18.8709C7.02311 19 6.76541 19 6.25 19C5.73459 19 5.47689 19 5.29493 18.8709C5.23072 18.8253 5.17466 18.7693 5.12911 18.7051C5 18.5231 5 18.2654 5 17.75Z"
                                    fill="#ffffff"></path>
                                <path
                                    d="M16 17.75C16 17.0478 16 16.6967 16.1685 16.4444C16.2415 16.3352 16.3352 16.2415 16.4444 16.1685C16.6967 16 17.0478 16 17.75 16C18.4522 16 18.8033 16 19.0556 16.1685C19.1648 16.2415 19.2585 16.3352 19.3315 16.4444C19.5 16.6967 19.5 17.0478 19.5 17.75C19.5 18.4522 19.5 18.8033 19.3315 19.0556C19.2585 19.1648 19.1648 19.2585 19.0556 19.3315C18.8033 19.5 18.4522 19.5 17.75 19.5C17.0478 19.5 16.6967 19.5 16.4444 19.3315C16.3352 19.2585 16.2415 19.1648 16.1685 19.0556C16 18.8033 16 18.4522 16 17.75Z"
                                    fill="#ffffff"></path>
                            </g>
                        </svg>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
    </form>

    {{-- Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal logic
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const sizeChartModal = document.getElementById('sizeChartModal');

            openModalBtn.addEventListener('click', function() {
                sizeChartModal.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', function() {
                sizeChartModal.classList.add('hidden');
            });

            // Close modal when clicking outside of the content
            window.addEventListener('click', function(event) {
                if (event.target == sizeChartModal) {
                    sizeChartModal.classList.add('hidden');
                }
            });
        });
    </script>


</x-shop-layout>
