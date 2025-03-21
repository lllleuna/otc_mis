@props(['active' => true])

<a class="{{ $active ? 'border-solid border-b-4 border-blue-600' : 'text-gray-600 hover:border-solid hover:border-b-4 hover:border-blue-400'}} mx-3 px-3 py-2 text-sm font-medium" aria-current="$active ? 'page' : 'false'" {{$attributes}}>
    {{$slot}}    
</a>