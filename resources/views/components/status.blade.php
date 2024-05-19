@props(['type' => 1])

@if ($type)
    <span class="bg-green-100 text-gray font-bold py-2 px-4 rounded">{{ __('Active') }}</span>
@else
    <span class="bg-red-100 text-gray font-bold py-2 px-4 rounded">{{ __('Inactive') }}</span>
@endif
