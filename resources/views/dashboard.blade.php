<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome, administrator!') }}
        </h2>
    </x-slot>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="bg-white sm:rounded-lg overflow-hidden">

                <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4">
                    {{-- Historial de ventas --}}
                    <a href="#"
                        class="block max-w-sm border border-gray-200 shadow hover:bg-indigo-800 bg-indigo-900 p-2 rounded-lg">

                        <div class="border-4 rounded-lg ">
                            <div class="flex justify-center items-center text-white mb-7 mt-7">
                                <svg data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"
                                    class="w-40 h-40" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex justify-center items-center mb-7 mt-7">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white text-white">Ver
                                    Historial de Ventas</h5>
                            </div>
                        </div>
                    </a>
                    {{-- Gestionar catlago --}}
                    <a href="{{route('products.index')}}"
                        class="block max-w-sm border border-gray-200 shadow hover:bg-indigo-800 bg-indigo-900 p-2 rounded-lg">

                        <div class="border-4 rounded-lg ">
                            <div class="flex justify-center items-center text-white mb-7 mt-7">
                                <svg data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"
                                    class="w-40 h-40"s xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex justify-center items-center mb-7 mt-7">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white text-white">
                                    Gestionar Catalogo</h5>
                            </div>
                        </div>
                    </a>
                    {{-- Ver solicitudes mayoristas --}}
                    <a href="#"
                        class="block max-w-sm border border-gray-200 shadow hover:bg-indigo-800 bg-indigo-900 p-2 rounded-lg">

                        <div class="border-4 rounded-lg ">
                            <div class="flex justify-center items-center text-white mb-7 mt-7">
                                <svg data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"
                                    class="w-40 h-40" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                        d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                                        fill-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex justify-center items-center mb-7 mt-7">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white text-white">Ver
                                    Solicitudes Mayoristas </h5>
                            </div>
                        </div>
                    </a>
                    {{-- Gestionar inventario --}}
                    <a href="{{route('stocks.index')}}"
                        class="block max-w-sm border border-gray-200 shadow hover:bg-indigo-800 bg-indigo-900 p-2 rounded-lg">

                        <div class="border-4 rounded-lg ">
                            <div class="flex justify-center items-center text-white mb-7 mt-7">
                                <svg data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" class="w-40 h-40"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                        d="M5.478 5.559A1.5 1.5 0 0 1 6.912 4.5H9A.75.75 0 0 0 9 3H6.912a3 3 0 0 0-2.868 2.118l-2.411 7.838a3 3 0 0 0-.133.882V18a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0 0 17.088 3H15a.75.75 0 0 0 0 1.5h2.088a1.5 1.5 0 0 1 1.434 1.059l2.213 7.191H17.89a3 3 0 0 0-2.684 1.658l-.256.513a1.5 1.5 0 0 1-1.342.829h-3.218a1.5 1.5 0 0 1-1.342-.83l-.256-.512a3 3 0 0 0-2.684-1.658H3.265l2.213-7.191Z"
                                        fill-rule="evenodd"></path>
                                    <path clip-rule="evenodd"
                                        d="M12 2.25a.75.75 0 0 1 .75.75v6.44l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 0 1 1.06-1.06l1.72 1.72V3a.75.75 0 0 1 .75-.75Z"
                                        fill-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex justify-center items-center mb-7 mt-7">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white text-white">Gestionar
                                    Inventario</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>


</x-app-layout>
