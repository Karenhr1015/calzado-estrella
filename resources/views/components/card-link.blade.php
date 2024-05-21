<a
    {{ $attributes->merge(['class' => 'block max-w-sm border border-gray-200 shadow hover:bg-indigo-800 bg-indigo-900 p-2 rounded-lg']) }}>

    <div class="border-4 rounded-lg ">
        <div class="flex justify-center items-center text-white mb-7 mt-7">
            {{ $icon }}
        </div>
        <div class="flex justify-center items-center mb-7 mt-7">
            <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white text-white">
                {{ $slot }}
            </h5>
        </div>
    </div>
</a>
