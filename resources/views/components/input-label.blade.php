@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
