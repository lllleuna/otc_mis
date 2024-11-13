<button {{ $attributes->merge(['class' => 'my-3 mx-5 px-3 py-2 rounded-lg text-sm bg-blue-900 text-white hover:bg-blue-600 focus:outline-none transition-colors'])}}>
    {{ $slot }}
</button>