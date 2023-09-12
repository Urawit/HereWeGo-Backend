@props(['title'])

<div class="group relative">

    {{ $slot }}

    <div class="hidden group-hover:block group-hover:translate-y-1 mt-6 absolute bg-gray-400 text-white rounded px-2 py-1 text-sm whitespace-nowrap">
        {{ $title }}
    </div>
</div>