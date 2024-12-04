@props(['active' => true])

<a class="{{ $active ? 'border-solid border-2 border-blue-600' : 'text-gray-600 hover:border-solid hover:border-b-4 hover:border-blue-400'}} flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5" aria-current="$active ? 'page' : 'false'" {{$attributes}}>
    {{$slot}}    
</a>