<button {{ $attributes->merge(['class' => 'my-3 px-4 py-2 rounded text-gray-800 hover:bg-gray-200 focus:outline-none transition-colors'])}} >

    {{ $slot }}
</button>