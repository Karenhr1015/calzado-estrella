<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Configuraciones
        </h2>
    </x-slot>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                {{-- Alertas --}}
                @if (session('status'))
                    <x-alert>
                        {{ session('status') }}
                    </x-alert>
                @endif
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">{{ __('Id') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Nombre') }}</th>
                                <th scope="col" class="px-4 py-3">{{ __('Valor') }}</th>
                                <th>{{-- Acciones --}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $setting)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $setting->id }}
                                    </th>
                                    <td class="px-4 py-3">{{ $setting->key }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $validator = true;
                                            foreach ($seasons as $item) {
                                                if ($item->id == $setting->value) {
                                                    echo $item->name;
                                                    $validator = false;
                                                    break;
                                                }
                                            }
                                            if ($validator) {
                                                echo 'Sin temporada activa';
                                            }
                                        @endphp
                                    </td>
                                    <td class="flex gap-5">
                                        <a href="{{ route('settings.edit', $setting->id) }}">
                                            <x-secondary-button>
                                                <div class="flex gap-2 items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 512 512">
                                                        <path fill="#7ba7d7"
                                                            d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </div>
                                            </x-secondary-button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            {{ $settings->links() }}
        </div>
    </section>
</x-app-layout>
