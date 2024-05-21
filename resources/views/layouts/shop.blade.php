<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <!-- Page Heading -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
                style="display: flex; justify-content: space-between;align-items: center;">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <img src="{{ asset('img/Logo.png') }}" alt="logo" style="width: 108px; height: 87px;">
                </h2>
                <div class="max-w-screen-lg" style="width: 550px;">
                    <form class="flex items-center" action="{{ route('raiz') }}" method="GET">
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
                                class=" border border-gray-300 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 bg-[#D5C4D7] text-[#080640]"
                                placeholder="{{ __('Search') }}" required="">
                        </div>
                        <button type="submit"></button>
                    </form>
                </div>
                <div class="flex gap-[45px]">
                    <a href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                            style="width: 41px; height: 41px;">
                            <path fill="#080640"
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                        </svg>
                    </a>
                    <a href="#">
                        <svg height="200px" width="200px" version="1.1" id="x32"
                            style="width: 41px; height: 41px;" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                            fill="#080640" stroke="#080640">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <style type="text/css">
                                    .st0 {
                                        fill: #080640;
                                    }
                                </style>
                                <g>
                                    <path class="st0"
                                        d="M486.998,140.232c-8.924-12.176-22.722-19.878-37.785-21.078l-311.616-24.68l-5.665-32.094 c-5.179-29.305-28.497-51.998-57.932-56.352l-5.662-0.845L34.65,0.185c-9.385-1.378-18.118,5.09-19.51,14.475 c-1.395,9.393,5.086,18.127,14.471,19.514v-0.008l39.357,5.834l0.009,0.026c14.788,2.164,26.526,13.586,29.131,28.324 l53.338,302.302c5.005,28.375,29.647,49.047,58.461,49.056h219.192c9.49,0,17.176-7.694,17.176-17.172 c0-9.486-7.686-17.18-17.176-17.18H209.906c-12.133,0.009-22.536-8.725-24.642-20.672l-7.461-42.299h244.342 c24.189,0,45.174-16.691,50.606-40.262l22.967-99.523C499.118,167.887,495.93,152.424,486.998,140.232z">
                                    </path>
                                    <path class="st0"
                                        d="M223.012,438.122c-20.402,0-36.935,16.554-36.935,36.948c0,20.394,16.533,36.931,36.935,36.931 c20.401,0,36.944-16.537,36.944-36.931C259.955,454.676,243.413,438.122,223.012,438.122z">
                                    </path>
                                    <path class="st0"
                                        d="M387.124,438.122c-20.406,0-36.935,16.554-36.935,36.948c0,20.394,16.529,36.931,36.935,36.931 c20.402,0,36.944-16.537,36.944-36.931C424.068,454.676,407.526,438.122,387.124,438.122z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
