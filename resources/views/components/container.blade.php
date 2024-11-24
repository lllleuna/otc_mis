<div {{ $attributes->merge(['class' => 'my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4'])}}>
    <div class="w-full flex flex-col 2xl:w-1/3">
        {{ $slot }}
    </div>
</div>