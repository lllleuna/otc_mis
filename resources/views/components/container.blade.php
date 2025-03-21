<div {{ $attributes->merge(['class' => 'bg-gray-100'])}}>
    <div class="w-full">
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>