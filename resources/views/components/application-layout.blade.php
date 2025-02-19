<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Application</x-slot:title>

    <div class="">
        <nav class="z-20 flex shrink-0 grow-0 justify-around gap-2 border-t border-gray-200 bg-white/50 p-2 shadow-lg backdrop-blur-lg dark:border-slate-600/60 dark:bg-slate-800/50 fixed top-2/4 -translate-y-2/4 left-6 min-h-[auto] min-w-[64px] flex-col rounded-lg border">
            <x-side-link href="/application" :active="request()->is('application')">
                <img src="{{ asset('images/icons8-mail-24.png') }}" alt="New Applications">
                <small class="text-center text-xs font-medium"> New </small>
            </x-side-link>
            <x-side-link href="/application/approved" :active="request()->is('application/approved')">
                <img src="{{ asset('images/icons8-approved-24.png') }}" alt="Approved Applications">
                <small class="text-center text-xs font-medium"> Review </small>
            </x-side-link>
            <x-side-link href="/application/processing" :active="request()->is('application/processing')">
                <img src="{{ asset('images/icons8-process-24.png') }}" alt="Processing Applications">
                <small class="text-center text-xs font-medium"> Processing </small>
            </x-side-link>
        </nav>

        {{ $slot }}

    </div>

</x-layout>
@include('components.footer')
