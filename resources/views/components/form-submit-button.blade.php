<button {{ $attributes->merge(['class' => 'float-right my-3 px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-colors', 'type' => 'submit'])}}>
    {{ $slot }}
</button>